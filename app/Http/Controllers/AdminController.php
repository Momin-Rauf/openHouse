<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project; 
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

        $projects = Project::all();

        
        

        $groups = User::where('role', 'group')->get();
        $guests = User::where('role', 'guest')->get();
        return Inertia::render('admin/Admin', [
            'groups'=>$groups,
            'guests'=>$guests,
            'Projects'=>$projects,
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

 
   
    public function admin_logout(Request $request){
        $user = $request->user();

        Auth::logout();


        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    
    

        
    }
