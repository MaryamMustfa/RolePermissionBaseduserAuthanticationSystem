<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get the authenticated user

        return view('admin.dashboard', ['user' => $user]);
    }

    public function logout()
    {
        Auth::logout(); // Logout the user
        return redirect()->route('loginform'); // Redirect to the login page
    }
}
