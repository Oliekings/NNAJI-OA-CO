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

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Currency *</label>
                        <select name="price_prefix" class="w-full px-3 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 bg-white">
                            <option value="₦" {{ old('price_prefix', '₦') === '₦' ? 'selected' : '' }}>NGN (₦) - Nigerian Naira</option>
                            <option value="$" {{ old('price_prefix') === '$' ? 'selected' : '' }}>USD ($) - US Dollar</option>
                            <option value="€" {{ old('price_prefix') === '€' ? 'selected' : '' }}>EUR (€) - Euro</option>
                            <option value="£" {{ old('price_prefix') === '£' ? 'selected' : '' }}>GBP (£) - British Pound</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Price (Amount)</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" placeholder="e.g. 750000000 or 1500000" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Price Unit / Suffix</label>
                        <input type="text" name="price_unit" value="{{ old('price_unit', 'total') }}" placeholder="e.g. total, net, per annum, POA" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">
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

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Building / Gross Floor Area</label>
                        <input type="text" name="building_area" value="{{ old('building_area') }}" placeholder="e.g. 1,800 sqm, 36 Suites across 3 Floors" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Title Document *</label>
                        <input type="text" list="title_doc_options_create" name="title_document" value="{{ old('title_document', 'Certificate of Occupancy (C of O)') }}" placeholder="e.g. Certificate of Occupancy (C of O), Governor's Consent" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">
                        <datalist id="title_doc_options_create">
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

                <!-- Video Media Upload (Optional or Standalone) -->
                <div class="bg-forest-950/5 p-4 sm:p-5 rounded-2xl border border-forest-800/20 space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-bold text-forest-950">
                            <i class="fa-solid fa-video text-gold-600 mr-1"></i> Property Video Tour / Walkthrough (Auto-Compressed)
                        </label>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-forest-800 bg-forest-100 px-2.5 py-0.5 rounded-md">Video Media</span>
                    </div>

                    <input type="file" id="video_file_input" name="video_file" accept=".mp4,.webm,.mov,.ogg,.ogv,.m4v,.avi,.3gp" class="block w-full text-xs text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-forest-900 file:text-gold-300 hover:file:bg-forest-800 cursor-pointer">
                    
                    <p class="text-[11px] text-slate-500 leading-relaxed">
                        Upload walkthrough or drone footage (.mp4, .webm, .mov). The system automatically captures a crisp HD thumbnail from the video to serve as the card cover and poster frame.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-slate-200">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1">Or paste video direct URL (e.g. Hostinger storage or external):</label>
                            <input type="text" id="video_url_input" name="video_url" value="{{ old('video_url') }}" placeholder="https://.../video.mp4 or /storage/properties/videos/..." class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-xs focus:ring-2 focus:ring-forest-800 focus:outline-none bg-white">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1">Custom Video Poster Thumbnail (Optional override):</label>
                            <input type="file" name="video_thumbnail_file" accept=".jpg,.jpeg,.png,.webp" class="block w-full text-xs text-slate-600 file:mr-2 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300 cursor-pointer">
                        </div>
                    </div>

                    <!-- Hidden Client-Side Extracted Poster Storage -->
                    <input type="hidden" name="client_video_thumbnail" id="client_video_thumbnail" value="{{ old('client_video_thumbnail') }}">

                    <!-- Live Video & Auto-Generated Poster Thumbnail Preview Box -->
                    <div id="video_preview_card" class="hidden p-4 rounded-xl bg-white border border-forest-800/30 shadow-sm space-y-3">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                            <span class="text-xs font-bold text-forest-950 flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-check text-emerald-600"></i> Video Loaded & Poster Frame Extracted
                            </span>
                            <span id="thumbnail_status_badge" class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">Ready</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Video Player Preview -->
                            <div>
                                <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Live Video Stream</label>
                                <video id="interactive_video_player" controls playsinline class="w-full h-44 rounded-lg bg-black object-contain shadow-inner"></video>
                                <button type="button" id="btn_capture_frame" class="mt-2 w-full py-1.5 px-3 rounded-lg bg-forest-900 hover:bg-forest-800 text-gold-300 text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-sm">
                                    <i class="fa-solid fa-camera"></i>
                                    <span>Capture Current Frame as Poster</span>
                                </button>
                            </div>

                            <!-- Extracted Poster Preview -->
                            <div>
                                <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Generated Cover Poster Thumbnail</label>
                                <div class="relative w-full h-44 rounded-lg bg-slate-900 border border-slate-200 overflow-hidden flex items-center justify-center">
                                    <img id="poster_preview_img" src="" alt="Video Poster" class="w-full h-full object-cover">
                                    <div class="absolute bottom-2 right-2 px-2 py-0.5 rounded bg-forest-950/80 text-white text-[10px] font-mono">Auto Poster</div>
                                </div>
                                <p class="text-[10px] text-slate-500 mt-1">This image will appear on property cards, search listings, and before the video plays.</p>
                            </div>
                        </div>
                    </div>
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

        <!-- Hidden Video Frame Grabber Canvas -->
        <canvas id="offscreen_canvas" class="hidden"></canvas>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const videoFileInput = document.getElementById('video_file_input');
    const videoUrlInput = document.getElementById('video_url_input');
    const videoPreviewCard = document.getElementById('video_preview_card');
    const interactiveVideo = document.getElementById('interactive_video_player');
    const posterPreviewImg = document.getElementById('poster_preview_img');
    const clientThumbInput = document.getElementById('client_video_thumbnail');
    const btnCaptureFrame = document.getElementById('btn_capture_frame');
    const canvas = document.getElementById('offscreen_canvas');
    const statusBadge = document.getElementById('thumbnail_status_badge');

    function extractPosterFromVideo(videoElem) {
        try {
            if (!videoElem.videoWidth || !videoElem.videoHeight) return;
            canvas.width = Math.min(videoElem.videoWidth, 1280);
            canvas.height = Math.round((videoElem.videoHeight / videoElem.videoWidth) * canvas.width);

            const ctx = canvas.getContext('2d');
            ctx.drawImage(videoElem, 0, 0, canvas.width, canvas.height);

            const dataUrl = canvas.toDataURL('image/webp', 0.85);
            if (dataUrl && dataUrl.length > 100) {
                clientThumbInput.value = dataUrl;
                posterPreviewImg.src = dataUrl;
                if (statusBadge) {
                    statusBadge.textContent = 'Frame Captured';
                    statusBadge.className = 'px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800';
                }
            }
        } catch (err) {
            console.warn('Canvas video capture note:', err);
        }
    }

    function loadVideoSource(src) {
        if (!src) return;
        videoPreviewCard.classList.remove('hidden');
        interactiveVideo.crossOrigin = 'anonymous';
        interactiveVideo.src = src;

        interactiveVideo.onloadedmetadata = () => {
            // Seek to 1s or middle to get a crisp non-black frame
            interactiveVideo.currentTime = Math.min(1.0, interactiveVideo.duration / 2);
        };

        interactiveVideo.onseeked = () => {
            if (!clientThumbInput.value || clientThumbInput.value === '') {
                extractPosterFromVideo(interactiveVideo);
            }
        };
    }

    if (videoFileInput) {
        videoFileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const objectUrl = URL.createObjectURL(file);
                clientThumbInput.value = '';
                loadVideoSource(objectUrl);
            }
        });
    }

    if (videoUrlInput) {
        videoUrlInput.addEventListener('input', (e) => {
            const url = e.target.value.trim();
            if (url && (url.startsWith('http') || url.startsWith('/storage') || url.endsWith('.mp4') || url.endsWith('.webm') || url.endsWith('.mov'))) {
                loadVideoSource(url);
            }
        });
    }

    if (btnCaptureFrame) {
        btnCaptureFrame.addEventListener('click', () => {
            extractPosterFromVideo(interactiveVideo);
        });
    }
});
</script>
@endsection
