<?php

namespace App\Http\Controllers;

use App\Models\User; // Assuming your model is named User
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\Evaluation;
use DB;

class AdminController extends Controller
{
    public function index()
    {
        // Retrieve project evaluations with related project and guest information


        
        $projects = DB::table('project_evaluations')->get();

        $groups = User::where('role', 'group')->get();
        $guests = User::where('role', 'guest')->get();
        return Inertia::render('admin/Admin', [
            'groups'=>$groups,
            'guests'=>$guests,
            'projects'=>$projects,
        ]);
    }

    public function create_user(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users',
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'group', // Assuming you want to create a group user
        ]);

        event(new Registered($user));

        return redirect()->route('admin.index')->with('success', 'User created successfully');
    }

 
   
    
    public function assignProjectsToGuests()
    {
        DB::beginTransaction();
    
        try {
            $guests = User::where('role', 'guest')->with('preferences')->get();
            $groups = User::where('role', 'group')->with('projects')->get();
    
            foreach ($guests as $guest) {
                $assignedProjects = [];
    
                foreach ($guest->preferences as $preference) {
                    $matchingGroups = $groups->filter(function ($group) use ($preference) {
                        return strpos($group->projects->assigned_words, $preference->preference) !== false;
                    });
    
                    foreach ($matchingGroups as $matchingGroup) {
                        $project = $matchingGroup->projects->random();
    
                        if (!in_array($project->id, $assignedProjects)) {
                            // Attach the project to the user and update the 'allocated' column
                            $guest->assignedProjects()->attach($project->id, ['allocated' => $guest->id]);
                            $assignedProjects[] = $project->id;
                            break;
                        }
                    }
                }
            }
    
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // Handle the exception, log, or throw it.
        }
    
        return $this->prepareDataForDisplay();
    }
    

        
    }
