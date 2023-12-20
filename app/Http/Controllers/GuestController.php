<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function guest_page(){
        return Inertia::render('guest/Guest');
    }

}
