<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $partners = TeamMember::partners()->get();
        $surveyors = TeamMember::surveyors()->get();

        return view('pages.about', compact('partners', 'surveyors'));
    }
}
