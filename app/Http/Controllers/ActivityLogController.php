<?php
namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activityLogs = ActivityLog::latest()->paginate(5);

        return view('activity-logs.index', compact('activityLogs'));
    }

    public function show($id)
    {
        $activityLog = ActivityLog::findOrFail($id);

        return view('activity-logs.show', compact('activityLog'));
    }

    public function create()
    {
        return view('activity-logs.create');
    }

    public function store(Request $request)
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $request->input('action'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('activity-logs.index')->with('success', 'Activity log created successfully!');
    }

    public function edit($id)
    {
        $activityLog = ActivityLog::findOrFail($id);

        return view('activity-logs.edit', compact('activityLog'));
    }

    public function update(Request $request, $id)
    {
        $activityLog = ActivityLog::findOrFail($id);

        $activityLog->update([
            'action' => $request->input('action'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('activity-logs.index')->with('success', 'Activity log updated successfully!');
    }

    public function destroy($id)
    {
        $activityLog = ActivityLog::findOrFail($id);
        $activityLog->delete();

        return redirect()->route('activity-logs.index')->with('success', 'Activity log deleted successfully!');
    }
}

