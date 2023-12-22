<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Illuminate\Support\Facades\DB;
use App\Models\Project;

use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function guest_page()
    {
        $projects = Project::where('allocated_to', auth()->id())->get();

        
        return Inertia::render('guest/Guest', [
            'projects' => $projects,
        ]);
    }

    public function rate(Request $request){
        

        DB::table('project_evaluations')->insert([
            'project_id' => $request->id,
            'evaluator_id' => auth()->id(),
            'rating' => $request->rate,
        ]);
        }

        public function guest_logout(Request $request){
            $user = $request->user();

            Auth::logout();
    
    
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            return redirect('/login');
        }
}

    
