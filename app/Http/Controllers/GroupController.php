<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        // Retrieve the group's projects
        $projects = Projects::where('group_id', Auth::id())->get();

        return Inertia::render('group/Group', [
            'projects' => $projects,
        ]);
    }

    public function assignKeywords(Request $request, $projectId)
    {
        // Logic to assign keywords to a project
        $keywords = $request->input('keywords');

        // Update the project's keywords
        Project::where('id', $projectId)->update(['assigned_words' => $keywords]);

        return redirect()->route('group.index')->with('success', 'Keywords assigned successfully');
    }
}
