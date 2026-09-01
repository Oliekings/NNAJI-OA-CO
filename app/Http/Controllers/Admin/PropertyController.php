<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query();

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->active();
            } elseif ($request->status === 'closed') {
                $query->closedDeals();
            } else {
                $query->where('status', $request->status);
            }
        }

        if ($request->filled('type')) {
            $query->where('property_type', $request->type);
        }

        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('reference_no', 'like', "%{$searchTerm}%")
                  ->orWhere('location_city', 'like', "%{$searchTerm}%");
            });
        }

        $properties = $query->latest()->paginate(12)->withQueryString();
        $activeCount = Property::active()->count();
        $closedCount = Property::closedDeals()->count();

        return view('admin.properties.index', compact('properties', 'activeCount', 'closedCount'));
    }

    public function create()
    {
        return view('admin.properties.create');
    }

    public function store(Request $request, \App\Services\ImageUploadService $imageService, \App\Services\VideoUploadService $videoService)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'property_type' => 'required|string',
            'listing_type' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'price_prefix' => 'nullable|string|max:20',
            'price_unit' => 'nullable|string',
            'location_address' => 'nullable|string',
            'location_city' => 'required|string',
            'location_state' => 'required|string',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'land_area' => 'nullable|string',
            'building_area' => 'nullable|string',
            'title_document' => 'nullable|string|max:255',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'featured_image' => 'nullable|string',
            'featured_image_file' => 'nullable|file|mimes:jpeg,jpg,png,webp|max:10240',
            'gallery_files.*' => 'nullable|file|mimes:jpeg,jpg,png,webp|max:10240',
            'video_url' => 'nullable|string|max:255',
            'video_file' => 'nullable|file|mimes:mp4,webm,mov,ogg,ogv,m4v,avi,3gp|max:102400',
            'video_thumbnail_file' => 'nullable|file|mimes:jpeg,jpg,png,webp|max:10240',
            'status' => 'required|string',
            'sold_price' => 'nullable|numeric|min:0',
            'sold_date' => 'nullable|date',
            'client_name' => 'nullable|string',
            'transaction_summary' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        // Process image uploads if provided
        try {
            if ($request->hasFile('featured_image_file')) {
                $validated['featured_image'] = $imageService->uploadAndOptimize(
                    $request->file('featured_image_file'),
                    'properties',
                    1920,
                    82
                );
            }
        } catch (\Throwable $e) {
            Log::error('Featured image upload error: ' . $e->getMessage());
            return back()->withInput()->withErrors(['featured_image_file' => $e->getMessage()]);
        }

        try {
            // Process multiple gallery uploads if provided
            $galleryImages = [];
            if ($request->hasFile('gallery_files')) {
                foreach ($request->file('gallery_files') as $galleryFile) {
                    if ($galleryFile && $galleryFile->isValid()) {
                        $galleryImages[] = $imageService->uploadAndOptimize($galleryFile, 'properties/gallery', 1600, 80);
                    }
                }
            }
            $validated['gallery_images'] = $galleryImages;
        } catch (\Throwable $e) {
            Log::error('Gallery upload error: ' . $e->getMessage());
            return back()->withInput()->withErrors(['gallery_files' => $e->getMessage()]);
        }

        try {
            // Process video upload and compression
            if ($request->hasFile('video_file')) {
                $videoResult = $videoService->uploadAndCompress(
                    $request->file('video_file'),
                    'properties/videos'
                );
                $validated['video_url'] = $videoResult['video_url'];
                if (!empty($videoResult['video_thumbnail'])) {
                    $validated['video_thumbnail'] = $videoResult['video_thumbnail'];
                }
            }

            // Process custom video thumbnail if provided
            if ($request->hasFile('video_thumbnail_file')) {
                $validated['video_thumbnail'] = $imageService->uploadAndOptimize(
                    $request->file('video_thumbnail_file'),
                    'properties/video-thumbnails',
                    1600,
                    82
                );
            }

            // If property has video but no featured image, fallback featured image to video thumbnail
            if (empty($validated['featured_image']) && !empty($validated['video_thumbnail'])) {
                $validated['featured_image'] = $validated['video_thumbnail'];
            }
        } catch (\Throwable $e) {
            Log::error('Video upload error: ' . $e->getMessage());
            return back()->withInput()->withErrors(['video_file' => 'Video upload error: ' . $e->getMessage()]);
        }

        // Process features into array
        if (!empty($validated['features'])) {
            $validated['features'] = array_filter(array_map('trim', preg_split('/[\r\n,]+/', $validated['features'])));
        } else {
            $validated['features'] = [];
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        $validated['reference_no'] = 'NOA-' . strtoupper(Str::random(6));

        if ($validated['status'] === 'sold' && empty($validated['sold_date'])) {
            $validated['sold_date'] = now()->toDateString();
        }

        try {
            $property = Property::create($validated);
        } catch (\Throwable $e) {
            Log::error('Property creation database error: ' . $e->getMessage());
            return back()->withInput()->withErrors(['general' => 'Database error: Please ensure migrations are run on the live server (`php artisan migrate --force`). Details: ' . $e->getMessage()]);
        }

        return redirect()->route('admin.properties.index')->with('success', "Property listing '{$property->title}' created successfully.");
    }

    public function edit(Property $property)
    {
        return view('admin.properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property, \App\Services\ImageUploadService $imageService, \App\Services\VideoUploadService $videoService)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'property_type' => 'required|string',
            'listing_type' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'price_prefix' => 'nullable|string|max:20',
            'price_unit' => 'nullable|string',
            'location_address' => 'nullable|string',
            'location_city' => 'required|string',
            'location_state' => 'required|string',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'land_area' => 'nullable|string',
            'building_area' => 'nullable|string',
            'title_document' => 'nullable|string|max:255',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'featured_image' => 'nullable|string',
            'featured_image_file' => 'nullable|file|mimes:jpeg,jpg,png,webp|max:10240',
            'gallery_files.*' => 'nullable|file|mimes:jpeg,jpg,png,webp|max:10240',
            'video_url' => 'nullable|string|max:255',
            'video_file' => 'nullable|file|mimes:mp4,webm,mov,ogg,ogv,m4v,avi,3gp|max:102400',
            'video_thumbnail_file' => 'nullable|file|mimes:jpeg,jpg,png,webp|max:10240',
            'status' => 'required|string',
            'sold_price' => 'nullable|numeric|min:0',
            'sold_date' => 'nullable|date',
            'client_name' => 'nullable|string',
            'transaction_summary' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        // Process featured image upload if provided
        try {
            if ($request->hasFile('featured_image_file')) {
                $validated['featured_image'] = $imageService->uploadAndOptimize(
                    $request->file('featured_image_file'),
                    'properties',
                    1920,
                    82
                );
            }
        } catch (\Throwable $e) {
            Log::error('Featured image update error: ' . $e->getMessage());
            return back()->withInput()->withErrors(['featured_image_file' => $e->getMessage()]);
        }

        try {
            // Process additional gallery files if provided
            if ($request->hasFile('gallery_files')) {
                $existingGallery = $property->gallery_images ?? [];
                foreach ($request->file('gallery_files') as $galleryFile) {
                    if ($galleryFile && $galleryFile->isValid()) {
                        $existingGallery[] = $imageService->uploadAndOptimize($galleryFile, 'properties/gallery', 1600, 80);
                    }
                }
                $validated['gallery_images'] = $existingGallery;
            }
        } catch (\Throwable $e) {
            Log::error('Gallery update error: ' . $e->getMessage());
            return back()->withInput()->withErrors(['gallery_files' => $e->getMessage()]);
        }

        try {
            // Process video file upload and compression if provided
            if ($request->hasFile('video_file')) {
                $videoResult = $videoService->uploadAndCompress(
                    $request->file('video_file'),
                    'properties/videos'
                );
                $validated['video_url'] = $videoResult['video_url'];
                if (!empty($videoResult['video_thumbnail'])) {
                    $validated['video_thumbnail'] = $videoResult['video_thumbnail'];
                }
            }

            // Process custom video thumbnail if provided
            if ($request->hasFile('video_thumbnail_file')) {
                $validated['video_thumbnail'] = $imageService->uploadAndOptimize(
                    $request->file('video_thumbnail_file'),
                    'properties/video-thumbnails',
                    1600,
                    82
                );
            }

            // If property has video but no featured image, fallback featured image to video thumbnail
            if (empty($validated['featured_image']) && empty($property->featured_image) && !empty($validated['video_thumbnail'])) {
                $validated['featured_image'] = $validated['video_thumbnail'];
            }
        } catch (\Throwable $e) {
            Log::error('Video update error: ' . $e->getMessage());
            return back()->withInput()->withErrors(['video_file' => 'Video upload error: ' . $e->getMessage()]);
        }

        if (!empty($validated['features'])) {
            $validated['features'] = array_filter(array_map('trim', preg_split('/[\r\n,]+/', $validated['features'])));
        } else {
            $validated['features'] = [];
        }

        $validated['is_featured'] = $request->has('is_featured');

        // Lifecycle automation: if status set to sold/leased and no sold date, set today
        if (in_array($validated['status'], ['sold', 'leased', 'valuation_closed']) && empty($validated['sold_date'])) {
            $validated['sold_date'] = now()->toDateString();
        }

        try {
            $property->update($validated);
        } catch (\Throwable $e) {
            Log::error('Property update database error: ' . $e->getMessage());
            return back()->withInput()->withErrors(['general' => 'Database error: Please ensure migrations are run on the live server (`php artisan migrate --force`). Details: ' . $e->getMessage()]);
        }

        return redirect()->route('admin.properties.index')->with('success', "Property '{$property->title}' updated successfully.");
    }

    /**
     * Automated Property Lifecycle Toggle:
     * One-click transition between "Active Listing" and "Sold / Closed Portfolio"
     */
    public function toggleStatus(Request $request, Property $property)
    {
        $targetStatus = $request->input('status');
        if (!in_array($targetStatus, ['available', 'under_offer', 'sold', 'leased', 'valuation_closed'])) {
            return back()->with('error', 'Invalid property status specified.');
        }

        $oldStatus = $property->status;
        $property->status = $targetStatus;

        if ($targetStatus === 'sold' || $targetStatus === 'leased') {
            if (!$property->sold_date) {
                $property->sold_date = now()->toDateString();
            }
            if (!$property->sold_price && $property->price) {
                $property->sold_price = $property->price;
            }
            if ($request->filled('transaction_summary')) {
                $property->transaction_summary = $request->transaction_summary;
            }
            $message = "Property '{$property->title}' marked as '{$targetStatus}' and automatically routed to the Closed Deals / Portfolio Archive.";
        } else {
            $message = "Property '{$property->title}' status set to '{$targetStatus}' and is now active on public listings.";
        }

        $property->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'status' => $property->status,
                'status_label' => $property->status_label,
                'status_badge' => $property->status_badge_class,
            ]);
        }

        return back()->with('success', $message);
    }

    public function destroy(Property $property)
    {
        $title = $property->title;
        $property->delete();

        return redirect()->route('admin.properties.index')->with('success', "Property '{$title}' was successfully removed.");
    }
}
