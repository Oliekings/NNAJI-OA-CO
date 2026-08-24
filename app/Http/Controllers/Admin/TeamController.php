<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function index()
    {
        $team = TeamMember::orderBy('sort_order')->get();
        return view('admin.team.index', compact('team'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request, \App\Services\ImageUploadService $imageService)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'cadre' => 'nullable|string|max:100',
            'registration_no' => 'nullable|string|max:100',
            'qualifications' => 'nullable|string|max:255',
            'experience_years' => 'nullable|string|max:100',
            'branch_location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|string|max:100',
            'bio' => 'required|string',
            'avatar' => 'nullable|string',
            'avatar_file' => 'nullable|file|mimes:jpeg,jpg,png,webp|max:10240',
            'is_partner' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        try {
            if ($request->hasFile('avatar_file')) {
                $validated['avatar'] = $imageService->uploadAndOptimize(
                    $request->file('avatar_file'),
                    'team',
                    800,
                    85
                );
            }
        } catch (\InvalidArgumentException $e) {
            return back()->withInput()->withErrors(['avatar_file' => $e->getMessage()]);
        }

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_partner'] = $request->has('is_partner');

        TeamMember::create($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member added.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', ['member' => $team]);
    }

    public function update(Request $request, TeamMember $team, \App\Services\ImageUploadService $imageService)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'cadre' => 'nullable|string|max:100',
            'registration_no' => 'nullable|string|max:100',
            'qualifications' => 'nullable|string|max:255',
            'experience_years' => 'nullable|string|max:100',
            'branch_location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|string|max:100',
            'bio' => 'required|string',
            'avatar' => 'nullable|string',
            'avatar_file' => 'nullable|file|mimes:jpeg,jpg,png,webp|max:10240',
            'is_partner' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        try {
            if ($request->hasFile('avatar_file')) {
                $validated['avatar'] = $imageService->uploadAndOptimize(
                    $request->file('avatar_file'),
                    'team',
                    800,
                    85
                );
            }
        } catch (\InvalidArgumentException $e) {
            return back()->withInput()->withErrors(['avatar_file' => $e->getMessage()]);
        }

        $validated['is_partner'] = $request->has('is_partner');

        $team->update($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $team)
    {
        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member removed.');
    }
}
