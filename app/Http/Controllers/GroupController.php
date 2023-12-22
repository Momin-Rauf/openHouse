<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use App\Models\Evaluation;
use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function group_page(){
        // $group_id = auth()->id();

        // // Fetch all projects for the group
        // $projects = Project::where('group_id', $group_id)->get();
        
        // // Initialize arrays to store project details and ratings
        // $projectDetails = [];
        // $projectRatings = [];
        
        // foreach ($projects as $project) {
        //     // Store project details
        //     $projectDetails[$project->id] = $project;
        
        //     // Fetch ratings for the current project
        //     // $ratings = DB::table('project_evaluations')where('project_id', $project->id)->get();
        
        //     // Store ratings for the current project
        //     $projectRatings[$project->id] = $ratings;
        // }
        
        $group_id = auth()->id();

        // Fetch all projects for the group
        $projectDetails = Project::where('group_id', $group_id)->first();
        $projectRatings = random_int(1, 10);
        return Inertia::render('group/Group', [
            'projectDetails' => $projectDetails,
            'projectRatings' => $projectRatings,
        ]);
        
    }

    public function assign_word(Request $request)
    {
        $guest = Preference::where('preference', $request->word)->first();
    
    
        if ($guest) {
            $project = Project::create([
                'name' => $request->Projectname,
                'assigned_words' => $request->word,
                'group_id' => $request->user()->id,
                'allocated_to' => $guest->id,
            ]);
        } else {
            die('error');
        }
    }


    public function group_logout(Request $request){
        $user = $request->user();

        Auth::logout();


        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
