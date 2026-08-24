<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:100',
            'short_description' => 'required|string',
            'full_description' => 'required|string',
            'scope_of_work' => 'nullable|string',
            'asset_classes' => 'nullable|string',
            'featured_image' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');
        $validated['scope_of_work'] = !empty($validated['scope_of_work']) ? array_filter(array_map('trim', preg_split('/[\r\n]+/', $validated['scope_of_work']))) : [];
        $validated['asset_classes'] = !empty($validated['asset_classes']) ? array_filter(array_map('trim', preg_split('/[\r\n]+/', $validated['asset_classes']))) : [];

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service added.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:100',
            'short_description' => 'required|string',
            'full_description' => 'required|string',
            'scope_of_work' => 'nullable|string',
            'asset_classes' => 'nullable|string',
            'featured_image' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['scope_of_work'] = !empty($validated['scope_of_work']) ? array_filter(array_map('trim', preg_split('/[\r\n]+/', $validated['scope_of_work']))) : [];
        $validated['asset_classes'] = !empty($validated['asset_classes']) ? array_filter(array_map('trim', preg_split('/[\r\n]+/', $validated['asset_classes']))) : [];

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }
}
