<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        // Retrieve evaluator's preferences
        $preferences = Auth::user()->preferences;

        return Inertia::render('guest/Guest', [
            'preferences' => $preferences,
        ]);
    }

    public function setPreferences(Request $request)
    {
        // Logic to set evaluator's preferences
        $preference = $request->input('preference');

        // Save or update the preference
        Auth::user()->preferences()->updateOrCreate([], ['preference' => $preference]);

        return redirect()->route('guest.index')->with('success', 'Preferences set successfully');
    }
}
