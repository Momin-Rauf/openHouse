<?php

namespace App\Http\Controllers;

use App\Models\User; // Assuming your model is named User
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AdminController extends Controller
{
    public function index()
    {
        $groups = User::where('role', 'group')->get();
        
        $guests = User::where('role', 'guest')->get();
        return Inertia::render('admin/Admin', [
            'groups'=>$groups,
            'guests'=>$guests
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

 
    private function prepareDataForDisplay()
    {
        // Retrieve all groups with their projects and assigned guests
        $groups = Group::with('projects.assignedGuests')->get();
    
        $dataUser = [];
    
        foreach ($groups as $group) {
            foreach ($group->projects as $project) {
                $projectName = $project->name;
    
                // Get the assigned guests for the project
                $assignedGuests = $project->assignedGuests;
    
                foreach ($assignedGuests as $assignedGuest) {
                    $guestName = $assignedGuest->name;
    
                    $dataUser[] = [
                        'group_name' => $group->name,
                        'project_name' => $projectName,
                        'assigned_guest' => $guestName,
                    ];
                }
            }
        }
    
        return Inertia::render('admin/Admin', ['dataUser' => $dataUser]);
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
