<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function group_page(){
        return Inertia::render('group/Group');
    }

}
