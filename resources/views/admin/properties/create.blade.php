@extends('layouts.admin')

@section('title', 'Add New Property Listing')
@section('header_title', 'Create Property Listing')
@section('header_subtitle', 'Publish new instructions or historical valuation records')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
        
        <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Basic Details -->
            <div class="space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-forest-900 border-b border-slate-100 pb-2">
                    1. Basic Property Information
                </h3>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Property Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. Prime 6-Storey Commercial Office Complex" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Property Type *</label>
                        <select name="property_type" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 bg-white">
                            <option value="Commercial">Commercial</option>
                            <option value="Residential">Residential</option>
                            <option value="Industrial">Industrial</option>
                            <option value="Agricultural">Agricultural</option>
                            <option value="Hospitality">Hospitality</option>
                            <option value="Land">Land / Development Plot</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Listing Type *</label>
                        <select name="listing_type" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 bg-white">
                            <option value="for_sale">For Sale</option>
                            <option value="for_lease">For Lease</option>
                            <option value="joint_venture">Joint Venture</option>
                            <option value="valuation_record">Valuation Record</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Initial Status *</label>
                        <select name="status" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 bg-white">
                            <option value="available">Active Listing (Available)</option>
                            <option value="under_offer">Under Offer</option>
                            <option value="sold">Sold (Route to Closed Portfolio)</option>
                            <option value="leased">Leased (Route to Closed Portfolio)</option>
                            <option value="valuation_closed">Valuation Completed</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Price (₦ Naira) *</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" placeholder="e.g. 750000000" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Price Unit / Suffix</label>
                        <input type="text" name="price_unit" value="{{ old('price_unit', 'total') }}" placeholder="e.g. total, per annum, POA" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Location & Specs -->
            <div class="space-y-4 pt-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-forest-900 border-b border-slate-100 pb-2">
                    2. Location & Cadastral Specs
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Address / Street</label>
                        <input type="text" name="location_address" value="{{ old('location_address') }}" placeholder="e.g. Plot 7 Yunus Ustaz Usman Rd, Abakpa GRA" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">City *</label>
                        <input type="text" name="location_city" value="{{ old('location_city', 'Abuja') }}" required placeholder="e.g. Abuja" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">State *</label>
                        <input type="text" name="location_state" value="{{ old('location_state', 'Abuja FCT') }}" required placeholder="e.g. Kaduna State" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Bedrooms</label>
                        <input type="number" name="bedrooms" value="{{ old('bedrooms') }}" placeholder="e.g. 5" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Bathrooms</label>
                        <input type="number" name="bathrooms" value="{{ old('bathrooms') }}" placeholder="e.g. 6" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Land Area</label>
                        <input type="text" name="land_area" value="{{ old('land_area') }}" placeholder="e.g. 2,500 sqm" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Description & Media -->
            <div class="space-y-4 pt-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-forest-900 border-b border-slate-100 pb-2">
                    3. Description, Imagery & Features
                </h3>

                <!-- Upload Section -->
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-3">
                    <label class="block text-xs font-bold text-slate-800 mb-1">
                        <i class="fa-solid fa-cloud-arrow-up text-gold-600 mr-1"></i> Upload Featured Image (Auto-Optimized & Secure)
                    </label>
                    <input type="file" name="featured_image_file" accept=".jpg,.jpeg,.png,.webp" class="block w-full text-xs text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-forest-900 file:text-gold-300 hover:file:bg-forest-800 cursor-pointer">
                    <p class="text-[11px] text-slate-500">
                        Upload standard image files (.jpg, .png, .webp). Images are automatically compressed to high-quality WebP format for fast loading and secured against malicious scripts.
                    </p>
                    <div class="pt-2 border-t border-slate-200">
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">Or paste external image URL:</label>
                        <input type="url" name="featured_image" value="{{ old('featured_image') }}" placeholder="https://..." class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-xs focus:ring-2 focus:ring-forest-800 focus:outline-none bg-white">
                    </div>
                </div>

                <!-- Gallery Uploads -->
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-2">
                    <label class="block text-xs font-bold text-slate-800 mb-1">
                        <i class="fa-solid fa-images text-gold-600 mr-1"></i> Additional Gallery Images (Optional)
                    </label>
                    <input type="file" name="gallery_files[]" multiple accept=".jpg,.jpeg,.png,.webp" class="block w-full text-xs text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-slate-700 file:text-white hover:file:bg-slate-800 cursor-pointer">
                    <p class="text-[11px] text-slate-500">Select multiple files to upload into the property dossier gallery.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Key Features (One per line or comma-separated)</label>
                    <textarea name="features" rows="3" placeholder="Certificate of Occupancy&#10;500kVA Dedicated Generator&#10;Central Air Conditioning" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">{{ old('features') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Full Description & Valuation Notes *</label>
                    <textarea name="description" rows="5" required placeholder="Detailed property particulars..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">{{ old('description') }}</textarea>
                </div>

                <div class="flex items-center space-x-2">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded text-forest-900 focus:ring-forest-800">
                    <label for="is_featured" class="text-xs font-bold text-slate-700">Display as Featured Listing on Homepage</label>
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end space-x-4">
                <a href="{{ route('admin.properties.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-bold text-xs">Cancel</a>
                <button type="submit" class="px-8 py-2.5 rounded-xl bg-forest-900 hover:bg-forest-800 text-white font-bold text-xs uppercase tracking-wider shadow">
                    Publish Property Listing
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
