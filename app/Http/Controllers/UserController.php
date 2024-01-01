<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $loginUser = auth()->user();
        $query = User::withTrashed()->with('roles');
        // Check if a search term is provided
        if ($request->has('search')) {
            $searchTerm = $request->input('search');


            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%$searchTerm%")
                  ->orWhere('email', 'like', "%$searchTerm%")
                  ->orWhereHas('roles', function ($roleQuery) use ($searchTerm) {
                  $roleQuery->where('name', 'like', "%$searchTerm%");
              });
        });



    }

    // Paginate the results
    $users = $query->paginate(5);

        return view('user.user', compact('users','loginUser'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.createuser', compact('roles'));
    }

    public function store(Request $request)
    {

        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        
        $user->roles()->attach($request->input('role_id'));

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('user.edituser', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
    
        $user = User::findOrFail($id);
        $credentials = $request->validate([
            'name' => 'string|max:255',
            'email' => [
                'email',
                Rule::unique('users')->ignore($user->id),
            ],    
        ]);
        
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        $user->roles()->sync([$request->input('role_id')]);



        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::withTrashed()->findOrFail($id);
    
        $user->roles->each(function ($role) {
            $role->permissions()->detach();
        });
    
        // Soft delete the user
        $user->delete();
    
        return redirect()->route('users.index')->with('success', 'User soft-deleted successfully.');
    }    

    public function deleteSelected(Request $request)
{
    $selectedIds = array_filter(explode(',', $request->input('selected_ids')));
    // dd($selectedIds); // Check if IDs are received correctly


    if (!empty($selectedIds)) {
        try {
            DB::beginTransaction();

            // Soft delete the selected users
            User::withTrashed()->whereIn('id', $selectedIds)->delete();

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Selected users soft-deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the exception or handle it as needed
            return redirect()->route('users.index')->with('error', 'Error soft-deleting selected users. Please try again.');
        }
    } else {
        return redirect()->route('users.index')->with('error', 'No users selected for deletion.');
    }
}
public function restore($id)
{
    $user = User::withTrashed()->findOrFail($id);

    try {
        DB::beginTransaction();

        // Restore the user
        $user->restore();

        DB::commit();

        return redirect()->route('users.index')->with('success', 'User restored successfully.');
    } catch (\Exception $e) {
        DB::rollBack();

        // Log the exception or handle it as needed
        return redirect()->route('users.index')->with('error', 'Error restoring user. Please try again.');
    }
}

public function forceDelete($id)
{
    $user = User::withTrashed()->findOrFail($id);

    try {
        DB::beginTransaction();

        // Force delete the user
        $user->forceDelete();

        DB::commit();

        return redirect()->route('users.index')->with('success', 'User permanently deleted successfully.');
    } catch (\Exception $e) {
        DB::rollBack();

        // Log the exception or handle it as needed
        return redirect()->route('users.index')->with('error', 'Error permanently deleting user. Please try again.');
    }
}

}
