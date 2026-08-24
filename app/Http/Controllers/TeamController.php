<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $partners = TeamMember::partners()->get();
        $surveyors = TeamMember::surveyors()->get();

        return view('pages.team.index', compact('partners', 'surveyors'));
    }

    public function show($slug)
    {
        $member = TeamMember::where('slug', $slug)->firstOrFail();
        $otherMembers = TeamMember::where('id', '!=', $member->id)->take(4)->get();

        return view('pages.team.show', compact('member', 'otherMembers'));
    }
}
