@extends('layouts.admin')

@section('title', 'Edit Property Listing')
@section('header_title', 'Edit Property Listing')
@section('header_subtitle', 'Update specifications and property lifecycle status')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
        
        <form action="{{ route('admin.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Section 1: Lifecycle Status Transition (Highlighted) -->
            <div class="p-6 rounded-2xl bg-forest-50 border border-forest-200 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-forest-800 block">Automated Routing Status</span>
                        <h3 class="font-bold text-forest-950 text-sm">Property Lifecycle & Visibility</h3>
                    </div>
                    <span class="px-3 py-1 text-xs font-bold rounded-full border {{ $property->status_badge_class }}">
                        Current: {{ $property->status_label }}
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-forest-950 mb-1">Target Lifecycle Status *</label>
                        <select name="status" id="property-status-select" required class="w-full px-3 py-2.5 rounded-xl border border-forest-300 text-xs font-bold focus:ring-2 focus:ring-forest-800 bg-white">
                            <option value="available" {{ $property->status === 'available' ? 'selected' : '' }}>Active Listing (Public Feed)</option>
                            <option value="under_offer" {{ $property->status === 'under_offer' ? 'selected' : '' }}>Under Offer (Public Feed)</option>
                            <option value="sold" {{ $property->status === 'sold' ? 'selected' : '' }}>Sold (Route to Closed Deals)</option>
                            <option value="leased" {{ $property->status === 'leased' ? 'selected' : '' }}>Leased (Route to Closed Deals)</option>
                            <option value="valuation_closed" {{ $property->status === 'valuation_closed' ? 'selected' : '' }}>Valuation Completed (Closed Deals)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-forest-950 mb-1">Transacted / Sold Price (₦)</label>
                        <input type="number" step="0.01" name="sold_price" value="{{ old('sold_price', $property->sold_price) }}" placeholder="e.g. 750000000" class="w-full px-3 py-2.5 rounded-xl border border-forest-300 text-xs focus:ring-2 focus:ring-forest-800 bg-white">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-forest-950 mb-1">Completion Date</label>
                        <input type="date" name="sold_date" value="{{ old('sold_date', $property->sold_date?->format('Y-m-d')) }}" class="w-full px-3 py-2.5 rounded-xl border border-forest-300 text-xs focus:ring-2 focus:ring-forest-800 bg-white">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-forest-950 mb-1">Client / Institutional Entity</label>
                        <input type="text" name="client_name" value="{{ old('client_name', $property->client_name) }}" placeholder="e.g. AMCON, NDDC, Private Investor" class="w-full px-3 py-2 rounded-xl border border-forest-300 text-xs bg-white">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-forest-950 mb-1">Closed Deal Summary Note</label>
                        <input type="text" name="transaction_summary" value="{{ old('transaction_summary', $property->transaction_summary) }}" placeholder="e.g. Executed comprehensive statutory asset valuation totaling ₦8.5B" class="w-full px-3 py-2 rounded-xl border border-forest-300 text-xs bg-white">
                    </div>
                </div>
            </div>

            <!-- Basic Details -->
            <div class="space-y-4 pt-2">
                <h3 class="text-xs font-bold uppercase tracking-wider text-forest-900 border-b border-slate-100 pb-2">
                    2. Listing Particulars
                </h3>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Property Title *</label>
                    <input type="text" name="title" value="{{ old('title', $property->title) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Property Type *</label>
                        <select name="property_type" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 bg-white">
                            <option value="Commercial" {{ $property->property_type === 'Commercial' ? 'selected' : '' }}>Commercial</option>
                            <option value="Residential" {{ $property->property_type === 'Residential' ? 'selected' : '' }}>Residential</option>
                            <option value="Industrial" {{ $property->property_type === 'Industrial' ? 'selected' : '' }}>Industrial</option>
                            <option value="Agricultural" {{ $property->property_type === 'Agricultural' ? 'selected' : '' }}>Agricultural</option>
                            <option value="Hospitality" {{ $property->property_type === 'Hospitality' ? 'selected' : '' }}>Hospitality</option>
                            <option value="Land" {{ $property->property_type === 'Land' ? 'selected' : '' }}>Land</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Listing Type *</label>
                        <select name="listing_type" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 bg-white">
                            <option value="for_sale" {{ $property->listing_type === 'for_sale' ? 'selected' : '' }}>For Sale</option>
                            <option value="for_lease" {{ $property->listing_type === 'for_lease' ? 'selected' : '' }}>For Lease</option>
                            <option value="joint_venture" {{ $property->listing_type === 'joint_venture' ? 'selected' : '' }}>Joint Venture</option>
                            <option value="valuation_record" {{ $property->listing_type === 'valuation_record' ? 'selected' : '' }}>Valuation Record</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Currency *</label>
                        <select name="price_prefix" class="w-full px-3 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 bg-white">
                            <option value="₦" {{ old('price_prefix', $property->price_prefix ?? '₦') === '₦' ? 'selected' : '' }}>NGN (₦) - Nigerian Naira</option>
                            <option value="$" {{ old('price_prefix', $property->price_prefix) === '$' ? 'selected' : '' }}>USD ($) - US Dollar</option>
                            <option value="€" {{ old('price_prefix', $property->price_prefix) === '€' ? 'selected' : '' }}>EUR (€) - Euro</option>
                            <option value="£" {{ old('price_prefix', $property->price_prefix) === '£' ? 'selected' : '' }}>GBP (£) - British Pound</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Price (Amount)</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $property->price) }}" placeholder="e.g. 750000000 or 1500000" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Price Unit</label>
                        <input type="text" name="price_unit" value="{{ old('price_unit', $property->price_unit) }}" placeholder="e.g. total, net, per annum, POA" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
                    </div>
                </div>
            </div>

            <!-- Location & Cadastral -->
            <div class="space-y-4 pt-2">
                <h3 class="text-xs font-bold uppercase tracking-wider text-forest-900 border-b border-slate-100 pb-2">
                    3. Location & Specs
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Address / Street</label>
                        <input type="text" name="location_address" value="{{ old('location_address', $property->location_address) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">City *</label>
                        <input type="text" name="location_city" value="{{ old('location_city', $property->location_city) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">State *</label>
                        <input type="text" name="location_state" value="{{ old('location_state', $property->location_state) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Bedrooms</label>
                        <input type="number" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Bathrooms</label>
                        <input type="number" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Land Area</label>
                        <input type="text" name="land_area" value="{{ old('land_area', $property->land_area) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Building / Gross Floor Area</label>
                        <input type="text" name="building_area" value="{{ old('building_area', $property->building_area) }}" placeholder="e.g. 1,800 sqm, 36 Suites across 3 Floors" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Title Document *</label>
                        <input type="text" list="title_doc_options_edit" name="title_document" value="{{ old('title_document', $property->title_document ?? 'Certificate of Occupancy (C of O)') }}" placeholder="e.g. Certificate of Occupancy (C of O), Governor's Consent" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
                        <datalist id="title_doc_options_edit">
                            <option value="Certificate of Occupancy (C of O)">
                            <option value="Right of Occupancy (R of O)">
                            <option value="Governor's Consent">
                            <option value="Deed of Assignment">
                            <option value="Federal C of O">
                            <option value="Registered Conveyance">
                            <option value="Gazette">
                            <option value="Excision">
                            <option value="Letter of Allocation">
                            <option value="Customary Grant">
                        </datalist>
                    </div>
                </div>
            </div>

            <!-- Description & Image -->
            <div class="space-y-4 pt-2">
                <h3 class="text-xs font-bold uppercase tracking-wider text-forest-900 border-b border-slate-100 pb-2">
                    4. Media, Imagery & Description
                </h3>

                <!-- Upload Section with Current Image Preview -->
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-3">
                    @if($property->featured_image)
                        <div class="flex items-center space-x-4 p-3 bg-white rounded-lg border border-slate-200">
                            <img src="{{ $property->featured_image }}" alt="{{ $property->title }}" class="w-20 h-14 object-cover rounded-md border border-slate-200">
                            <div>
                                <span class="text-[10px] uppercase font-bold text-slate-500 block">Current Featured Image</span>
                                <span class="text-xs text-forest-900 font-medium truncate block max-w-md">{{ $property->featured_image }}</span>
                            </div>
                        </div>
                    @endif

                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            <i class="fa-solid fa-cloud-arrow-up text-gold-600 mr-1"></i> Upload New Featured Image (Auto-Optimized & Secure)
                        </label>
                        <input type="file" name="featured_image_file" accept=".jpg,.jpeg,.png,.webp" class="block w-full text-xs text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-forest-900 file:text-gold-300 hover:file:bg-forest-800 cursor-pointer">
                        <p class="text-[11px] text-slate-500 mt-1">
                            Selecting a new file will automatically convert and optimize the image to clean WebP format while stripping EXIF/code payloads.
                        </p>
                    </div>

                    <div class="pt-2 border-t border-slate-200">
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">Or direct image URL:</label>
                        <input type="url" name="featured_image" value="{{ old('featured_image', $property->featured_image) }}" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-xs focus:ring-2 focus:ring-forest-800 bg-white">
                    </div>
                </div>

                <!-- Gallery Uploads -->
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-2">
                    <label class="block text-xs font-bold text-slate-800 mb-1">
                        <i class="fa-solid fa-images text-gold-600 mr-1"></i> Upload Additional Gallery Images (Optional)
                    </label>
                    <input type="file" name="gallery_files[]" multiple accept=".jpg,.jpeg,.png,.webp" class="block w-full text-xs text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-slate-700 file:text-white hover:file:bg-slate-800 cursor-pointer">
                    @if(!empty($property->gallery_images) && is_array($property->gallery_images))
                        <div class="flex items-center space-x-2 pt-2 overflow-x-auto">
                            @foreach($property->gallery_images as $gImg)
                                <img src="{{ $gImg }}" class="w-12 h-12 object-cover rounded border border-slate-300">
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Video Media Upload & Preview Section -->
                <div class="bg-forest-950/5 p-4 sm:p-5 rounded-2xl border border-forest-800/20 space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-bold text-forest-950">
                            <i class="fa-solid fa-video text-gold-600 mr-1"></i> Property Video Tour / Walkthrough (Auto-Compressed)
                        </label>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-forest-800 bg-forest-100 px-2.5 py-0.5 rounded-md">Video Media</span>
                    </div>

                    @if($property->video_url)
                        <div class="p-4 bg-white rounded-xl border border-slate-200 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] uppercase font-bold text-slate-500">Current Video Dossier</span>
                                <a href="{{ $property->video_url }}" target="_blank" class="text-[11px] text-gold-700 hover:underline font-bold flex items-center gap-1">
                                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> Open Fullscreen Video
                                </a>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Live Video Stream</label>
                                    <div class="rounded-lg overflow-hidden border border-slate-200 bg-black">
                                        <video id="existing_video_player" controls playsinline class="w-full h-44 object-contain" preload="metadata" poster="{{ $property->video_thumbnail ?? $property->featured_image }}">
                                            <source src="{{ $property->video_url }}">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    <button type="button" id="btn_capture_existing_frame" class="mt-2 w-full py-1.5 px-3 rounded-lg bg-forest-900 hover:bg-forest-800 text-gold-300 text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-sm">
                                        <i class="fa-solid fa-camera"></i>
                                        <span>Capture Current Frame as New Poster</span>
                                    </button>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Current Poster Frame Thumbnail</label>
                                    <div class="relative w-full h-44 rounded-lg bg-slate-900 border border-slate-200 overflow-hidden flex items-center justify-center">
                                        @if($property->video_thumbnail)
                                            <img id="current_poster_img" src="{{ $property->video_thumbnail }}" alt="Current Poster" class="w-full h-full object-cover">
                                        @else
                                            <div id="no_poster_badge" class="text-center text-slate-400 text-xs p-4">
                                                <i class="fa-solid fa-image text-2xl mb-1 block"></i>
                                                <span>No thumbnail generated yet.<br>Click "Capture Current Frame" on the left!</span>
                                            </div>
                                            <img id="current_poster_img" src="" alt="Captured Poster" class="hidden w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <span class="text-[10px] text-slate-500 mt-1 block font-mono truncate">{{ $property->video_url }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">Upload New Video File (.mp4, .webm, .mov):</label>
                        <input type="file" id="video_file_input" name="video_file" accept=".mp4,.webm,.mov,.ogg,.ogv,.m4v,.avi,.3gp" class="block w-full text-xs text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-forest-900 file:text-gold-300 hover:file:bg-forest-800 cursor-pointer">
                        <p class="text-[11px] text-slate-500 mt-1">
                            Videos are automatically compressed for web streaming. If this property has no photos, the video and its poster will serve as the primary media.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-slate-200">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1">Or direct video / embed URL (e.g. storage or external):</label>
                            <input type="text" id="video_url_input" name="video_url" value="{{ old('video_url', $property->video_url) }}" placeholder="https://... or /storage/properties/videos/..." class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-xs focus:ring-2 focus:ring-forest-800 bg-white">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1">Custom Video Poster Thumbnail (Optional override):</label>
                            <input type="file" name="video_thumbnail_file" accept=".jpg,.jpeg,.png,.webp" class="block w-full text-xs text-slate-600 file:mr-2 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300 cursor-pointer">
                        </div>
                    </div>

                    <!-- Hidden Client-Side Extracted Poster Storage -->
                    <input type="hidden" name="client_video_thumbnail" id="client_video_thumbnail" value="">

                    <!-- New Upload Preview Box (when new file or URL is entered) -->
                    <div id="new_video_preview_card" class="hidden p-4 rounded-xl bg-white border border-forest-800/30 shadow-sm space-y-3">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                            <span class="text-xs font-bold text-forest-950 flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-check text-emerald-600"></i> New Video Source Loaded
                            </span>
                            <span id="new_thumbnail_status_badge" class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">Poster Extracted</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">New Video Stream</label>
                                <video id="new_interactive_video" controls playsinline class="w-full h-44 rounded-lg bg-black object-contain shadow-inner"></video>
                                <button type="button" id="btn_capture_new_frame" class="mt-2 w-full py-1.5 px-3 rounded-lg bg-forest-900 hover:bg-forest-800 text-gold-300 text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-sm">
                                    <i class="fa-solid fa-camera"></i>
                                    <span>Capture Frame as Poster</span>
                                </button>
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">New Auto Poster Thumbnail</label>
                                <div class="relative w-full h-44 rounded-lg bg-slate-900 border border-slate-200 overflow-hidden flex items-center justify-center">
                                    <img id="new_poster_preview_img" src="" alt="New Poster" class="w-full h-full object-cover">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Key Features (Newline separated)</label>
                    <textarea name="features" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">{{ old('features', is_array($property->features) ? implode("\n", $property->features) : $property->features) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Full Description *</label>
                    <textarea name="description" rows="5" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">{{ old('description', $property->description) }}</textarea>
                </div>

                <div class="flex items-center space-x-2">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $property->is_featured) ? 'checked' : '' }} class="rounded text-forest-900 focus:ring-forest-800">
                    <label for="is_featured" class="text-xs font-bold text-slate-700">Display as Featured Listing on Homepage</label>
                </div>
            </div>

            <!-- Buttons -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end space-x-4">
                <a href="{{ route('admin.properties.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-bold text-xs">Cancel</a>
                <button type="submit" class="px-8 py-2.5 rounded-xl bg-forest-900 hover:bg-forest-800 text-white font-bold text-xs uppercase tracking-wider shadow">
                    Save Changes & Update Dossier
                </button>
            </div>

        </form>

        <!-- Hidden Video Frame Grabber Canvas -->
        <canvas id="offscreen_canvas" class="hidden"></canvas>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const videoFileInput = document.getElementById('video_file_input');
    const videoUrlInput = document.getElementById('video_url_input');
    const newVideoPreviewCard = document.getElementById('new_video_preview_card');
    const newInteractiveVideo = document.getElementById('new_interactive_video');
    const newPosterPreviewImg = document.getElementById('new_poster_preview_img');
    const clientThumbInput = document.getElementById('client_video_thumbnail');
    const btnCaptureNewFrame = document.getElementById('btn_capture_new_frame');
    const btnCaptureExistingFrame = document.getElementById('btn_capture_existing_frame');
    const existingVideo = document.getElementById('existing_video_player');
    const currentPosterImg = document.getElementById('current_poster_img');
    const noPosterBadge = document.getElementById('no_poster_badge');
    const canvas = document.getElementById('offscreen_canvas');

    function extractPoster(videoElem, targetImg) {
        try {
            if (!videoElem.videoWidth || !videoElem.videoHeight) return;
            canvas.width = Math.min(videoElem.videoWidth, 1280);
            canvas.height = Math.round((videoElem.videoHeight / videoElem.videoWidth) * canvas.width);

            const ctx = canvas.getContext('2d');
            ctx.drawImage(videoElem, 0, 0, canvas.width, canvas.height);

            const dataUrl = canvas.toDataURL('image/webp', 0.85);
            if (dataUrl && dataUrl.length > 100) {
                clientThumbInput.value = dataUrl;
                if (targetImg) {
                    targetImg.src = dataUrl;
                    targetImg.classList.remove('hidden');
                }
                if (noPosterBadge) {
                    noPosterBadge.classList.add('hidden');
                }
            }
        } catch (err) {
            console.warn('Canvas capture note:', err);
        }
    }

    if (btnCaptureExistingFrame && existingVideo) {
        btnCaptureExistingFrame.addEventListener('click', () => {
            extractPoster(existingVideo, currentPosterImg);
            btnCaptureExistingFrame.innerHTML = '<i class="fa-solid fa-check text-emerald-400"></i> <span>Frame Saved! Click "Save Changes"</span>';
        });
    }

    function loadNewVideo(src) {
        if (!src) return;
        newVideoPreviewCard.classList.remove('hidden');
        newInteractiveVideo.crossOrigin = 'anonymous';
        newInteractiveVideo.src = src;

        newInteractiveVideo.onloadedmetadata = () => {
            newInteractiveVideo.currentTime = Math.min(1.0, newInteractiveVideo.duration / 2);
        };

        newInteractiveVideo.onseeked = () => {
            extractPoster(newInteractiveVideo, newPosterPreviewImg);
        };
    }

    if (videoFileInput) {
        videoFileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const objectUrl = URL.createObjectURL(file);
                loadNewVideo(objectUrl);
            }
        });
    }

    if (videoUrlInput) {
        videoUrlInput.addEventListener('input', (e) => {
            const url = e.target.value.trim();
            if (url && url !== "{{ $property->video_url }}" && (url.startsWith('http') || url.startsWith('/storage') || url.endsWith('.mp4') || url.endsWith('.webm') || url.endsWith('.mov'))) {
                loadNewVideo(url);
            }
        });
    }

    if (btnCaptureNewFrame) {
        btnCaptureNewFrame.addEventListener('click', () => {
            extractPoster(newInteractiveVideo, newPosterPreviewImg);
        });
    }
});
</script>
@endsection
