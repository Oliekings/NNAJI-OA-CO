@extends('layouts.app')

@section('title', $property->title . ' | NNAJI O.A & COMPANY')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($property->description), 160))
@section('og_image', $property->featured_image ? $property->featured_image : asset('images/og-share-banner.jpg'))

@section('content')

    <!-- Breadcrumb & Top Bar -->
    <div class="bg-forest-950 text-slate-300 py-6 border-b border-forest-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center space-x-2 text-xs">
                <a href="{{ route('home') }}" class="hover:text-gold-400">Home</a>
                <span>/</span>
                @if(in_array($property->status, ['sold', 'leased', 'valuation_closed']))
                    <a href="{{ route('properties.portfolio') }}" class="hover:text-gold-400">Closed Deals Portfolio</a>
                @else
                    <a href="{{ route('properties.index') }}" class="hover:text-gold-400">Active Listings</a>
                @endif
                <span>/</span>
                <span class="text-gold-300 truncate max-w-xs">{{ $property->title }}</span>
            </div>
            
            <div class="flex items-center space-x-3">
                <span class="px-3 py-1 text-xs font-mono rounded bg-forest-900 border border-forest-700 text-gold-300">
                    Ref: {{ $property->reference_no }}
                </span>
                <span class="px-3 py-1 text-xs font-bold uppercase rounded-full {{ $property->status_badge_class }}">
                    {{ $property->status_label }}
                </span>
            </div>
        </div>
    </div>

    <!-- Main Property Detail -->
    <div class="py-12 bg-ivory-base">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                
                <!-- Left Main Content (8 cols) -->
                <div class="lg:col-span-8 space-y-8">
                    
                    <!-- Main Hero Image / Video Media -->
                    <div class="bg-white rounded-3xl overflow-hidden border border-ivory-border shadow-md">
                        @if($property->featured_image)
                            <div class="relative h-96 sm:h-[480px] bg-slate-900 group cursor-pointer" data-lightbox-src="{{ $property->featured_image }}" data-title="{{ $property->title }}" data-gallery="property-{{ $property->id }}">
                                <img src="{{ $property->featured_image }}" alt="{{ $property->title }}" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">

                                <div class="absolute inset-0 bg-gradient-to-t from-forest-950/85 via-forest-950/20 to-transparent"></div>
                                
                                <!-- Floating Zoom Enlarge Badge -->
                                <div class="absolute top-5 right-5 z-10 px-3.5 py-1.5 rounded-full bg-forest-900/90 hover:bg-gold-500 text-gold-300 hover:text-forest-950 border border-gold-500/40 backdrop-blur-md text-xs font-bold transition-all duration-300 flex items-center gap-1.5 shadow-lg group-hover:scale-105">
                                    <i class="fa-solid fa-magnifying-glass-plus text-xs"></i>
                                    <span>Click to Enlarge & Zoom</span>
                                </div>

                                <div class="absolute bottom-6 left-6 right-6 text-white flex flex-col sm:flex-row sm:items-end justify-between gap-4 z-10">
                                    <div>
                                        <span class="text-xs uppercase font-bold text-gold-300 tracking-wider block">
                                            {{ $property->property_type }} &bull; {{ str_replace('_', ' ', strtoupper($property->listing_type)) }}
                                        </span>
                                        <h1 class="heading-serif text-2xl sm:text-3xl font-bold text-white mt-1">
                                            {{ $property->title }}
                                        </h1>
                                        <div class="flex items-center text-xs text-slate-300 mt-2">
                                            <i class="fa-solid fa-location-dot text-gold-400 mr-1.5"></i>
                                            <span>{{ $property->location_address ? $property->location_address . ', ' : '' }}{{ $property->location_city }}, {{ $property->location_state }}</span>
                                        </div>
                                    </div>

                                    <div class="bg-forest-900/90 backdrop-blur-md p-4 rounded-2xl border border-gold-500/40 text-right">
                                        <span class="text-[10px] uppercase font-bold text-gold-300 tracking-wider block">
                                            {{ in_array($property->status, ['sold', 'leased']) ? 'Transacted Value' : 'Guide Price / Asking' }}
                                        </span>
                                        <span class="text-xl sm:text-2xl font-bold font-cinzel text-white">
                                            {{ $property->formatted_sold_price ?? $property->formatted_price }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @elseif($property->has_video)
                            <!-- Video-Only Primary Media Display -->
                            <div class="relative bg-black rounded-3xl overflow-hidden">
                                <video controls playsinline class="w-full h-96 sm:h-[480px] object-cover" poster="{{ $property->video_thumbnail }}">
                                    <source src="{{ $property->video_url }}">
                                    Your browser does not support the video tag.
                                </video>
                                <div class="p-6 bg-forest-950 text-white flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                                    <div>
                                        <span class="text-xs uppercase font-bold text-gold-300 tracking-wider block">
                                            {{ $property->property_type }} &bull; {{ str_replace('_', ' ', strtoupper($property->listing_type)) }}
                                        </span>
                                        <h1 class="heading-serif text-2xl sm:text-3xl font-bold text-white mt-1">
                                            {{ $property->title }}
                                        </h1>
                                        <div class="flex items-center text-xs text-slate-300 mt-2">
                                            <i class="fa-solid fa-location-dot text-gold-400 mr-1.5"></i>
                                            <span>{{ $property->location_address ? $property->location_address . ', ' : '' }}{{ $property->location_city }}, {{ $property->location_state }}</span>
                                        </div>
                                    </div>
                                    <div class="bg-forest-900/90 backdrop-blur-md p-4 rounded-2xl border border-gold-500/40 text-right">
                                        <span class="text-[10px] uppercase font-bold text-gold-300 tracking-wider block">
                                            {{ in_array($property->status, ['sold', 'leased']) ? 'Transacted Value' : 'Guide Price / Asking' }}
                                        </span>
                                        <span class="text-xl sm:text-2xl font-bold font-cinzel text-white">
                                            {{ $property->formatted_sold_price ?? $property->formatted_price }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="relative min-h-[260px] bg-forest-950 flex flex-col justify-between p-8">
                                <div class="flex items-center space-x-3 text-gold-400">
                                    <i class="fa-solid fa-building text-3xl"></i>
                                    <span class="text-xs uppercase font-bold tracking-widest text-gold-300">
                                        {{ $property->property_type }} &bull; {{ str_replace('_', ' ', strtoupper($property->listing_type)) }}
                                    </span>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mt-6">
                                    <div>
                                        <h1 class="heading-serif text-2xl sm:text-3xl font-bold text-white">
                                            {{ $property->title }}
                                        </h1>
                                        <div class="flex items-center text-xs text-slate-300 mt-2">
                                            <i class="fa-solid fa-location-dot text-gold-400 mr-1.5"></i>
                                            <span>{{ $property->location_address ? $property->location_address . ', ' : '' }}{{ $property->location_city }}, {{ $property->location_state }}</span>
                                        </div>
                                    </div>
                                    <div class="bg-forest-900/90 p-4 rounded-2xl border border-gold-500/40 text-right">
                                        <span class="text-[10px] uppercase font-bold text-gold-300 tracking-wider block">
                                            {{ in_array($property->status, ['sold', 'leased']) ? 'Transacted Value' : 'Guide Price / Asking' }}
                                        </span>
                                        <span class="text-xl sm:text-2xl font-bold font-cinzel text-white">
                                            {{ $property->formatted_sold_price ?? $property->formatted_price }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Gallery Thumbnails (Clickable with Zoom) -->
                        @if(!empty($property->gallery_images) && is_array($property->gallery_images))
                            <div class="p-4 grid grid-cols-3 sm:grid-cols-4 gap-3 bg-slate-50 border-t border-slate-200">
                                @foreach($property->gallery_images as $index => $thumb)
                                    <div class="group/thumb relative h-24 rounded-xl overflow-hidden border border-slate-200 cursor-pointer shadow-sm hover:shadow-md transition-all" data-gallery-src="{{ $thumb }}" data-title="{{ $property->title }} - View {{ $index + 1 }}" data-gallery="property-{{ $property->id }}">
                                        <img src="{{ $thumb }}" alt="{{ $property->title }} gallery" class="w-full h-full object-cover transition-transform duration-500 group-hover/thumb:scale-110">
                                        <div class="absolute inset-0 bg-forest-950/0 group-hover/thumb:bg-forest-950/40 transition-colors flex items-center justify-center">
                                            <i class="fa-solid fa-magnifying-glass-plus text-white opacity-0 group-hover/thumb:opacity-100 transition-opacity text-sm"></i>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Video Tour & Walkthrough Section (if video exists with images) -->
                    @if($property->has_video && $property->featured_image)
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-ivory-border shadow-md space-y-4">
                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-xl bg-forest-900 text-gold-400 flex items-center justify-center shadow-sm">
                                        <i class="fa-solid fa-video text-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-base sm:text-lg font-bold text-forest-950">Video Tour & Walkthrough</h3>
                                        <p class="text-xs text-slate-500">Live asset inspection footage and aerial perspective</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-lg bg-red-100 text-red-700 border border-red-200">
                                    <i class="fa-solid fa-circle-play mr-1 text-[9px]"></i> Video Stream
                                </span>
                            </div>

                            <div class="rounded-2xl overflow-hidden bg-black shadow-inner border border-slate-200">
                                <video controls playsinline class="w-full max-h-[500px]" preload="metadata" poster="{{ $property->video_thumbnail ?? $property->featured_image }}">
                                    <source src="{{ $property->video_url }}">
                                    Your browser does not support HTML5 video streaming.
                                </video>
                            </div>
                        </div>
                    @endif

                    <!-- Key Property Specs Summary -->
                    <div class="bg-white rounded-2xl p-6 border border-ivory-border shadow-sm">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-forest-900 mb-4 border-b border-slate-100 pb-2">
                            Key Specifications & Cadastral Metrics
                        </h3>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
                            <div class="bg-forest-50 p-3 rounded-xl border border-forest-100">
                                <span class="text-[11px] text-slate-500 block uppercase font-bold">Property Type</span>
                                <span class="text-sm font-bold text-forest-900">{{ $property->property_type }}</span>
                            </div>
                            <div class="bg-forest-50 p-3 rounded-xl border border-forest-100">
                                <span class="text-[11px] text-slate-500 block uppercase font-bold">Land / Site Area</span>
                                <span class="text-sm font-bold text-forest-900">{{ $property->land_area ?? 'Per Site Plan' }}</span>
                            </div>
                            <div class="bg-forest-50 p-3 rounded-xl border border-forest-100">
                                <span class="text-[11px] text-slate-500 block uppercase font-bold">Building Space</span>
                                <span class="text-sm font-bold text-forest-900">{{ $property->building_area ?? 'Configured Bay' }}</span>
                            </div>
                            <div class="bg-forest-50 p-3 rounded-xl border border-forest-100">
                                <span class="text-[11px] text-slate-500 block uppercase font-bold">Title Document</span>
                                <span class="text-sm font-bold text-forest-900">{{ $property->title_document ?? 'Certificate of Occupancy (C of O)' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Detailed Description -->
                    <div class="bg-white rounded-2xl p-8 border border-ivory-border shadow-sm space-y-4">
                        <h3 class="heading-serif text-xl font-bold text-slate-900">
                            Asset Overview & Professional Assessment
                        </h3>
                        <div class="text-slate-700 text-sm leading-relaxed whitespace-pre-line">
                            {{ $property->description }}
                        </div>
                    </div>

                    <!-- Verified Features & Amenities -->
                    @if(!empty($property->features) && is_array($property->features))
                        <div class="bg-white rounded-2xl p-8 border border-ivory-border shadow-sm">
                            <h3 class="heading-serif text-xl font-bold text-slate-900 mb-4">
                                Verified Infrastructure & Features
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($property->features as $feature)
                                    <div class="flex items-center text-xs text-slate-700 bg-slate-50 p-3 rounded-xl border border-slate-100">
                                        <i class="fa-solid fa-circle-check text-emerald-600 mr-2.5 text-sm"></i>
                                        <span>{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Closed Deal / Historical Case Study Details (if Sold) -->
                    @if(in_array($property->status, ['sold', 'leased', 'valuation_closed']))
                        <div class="bg-gradient-to-br from-forest-950 to-forest-900 text-white rounded-2xl p-8 border border-gold-500/40 shadow-xl">
                            <div class="flex items-center space-x-2 text-gold-300 text-xs font-bold uppercase tracking-wider mb-2">
                                <i class="fa-solid fa-award text-gold-400"></i>
                                <span>Closed Transaction / Case Record</span>
                            </div>
                            <h3 class="text-xl font-bold font-serif text-white mb-2">
                                Mandate Completion & Corporate Results
                            </h3>
                            @if($property->client_name)
                                <p class="text-xs text-slate-300 mb-2"><strong>Client / Authority:</strong> {{ $property->client_name }}</p>
                            @endif
                            @if($property->sold_date)
                                <p class="text-xs text-slate-300 mb-2"><strong>Completion Date:</strong> {{ $property->sold_date->format('F d, Y') }}</p>
                            @endif
                            <p class="text-sm text-slate-200 mt-2 leading-relaxed">
                                {{ $property->transaction_summary ?? 'This asset mandate was successfully executed by NNAJI O.A & COMPANY complying with all statutory valuation and estate management guidelines.' }}
                            </p>
                        </div>
                    @endif

                </div>

                <!-- Right Sidebar (4 cols) -->
                <div class="lg:col-span-4 space-y-6">
                    
                    <!-- Direct Broker Inquiry / Schedule Inspection Form -->
                    <div class="bg-white rounded-3xl p-6 sm:p-8 border-2 border-gold-500/30 shadow-xl sticky top-24">
                        <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-gold-700 block">Direct Mandate Desk</span>
                                <h4 class="text-base font-bold font-serif text-forest-950">Inquire About This Asset</h4>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-forest-900 text-gold-400 flex items-center justify-center text-xs">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                        </div>

                        <form action="{{ route('inquiry.store') }}" method="POST" class="space-y-3">
                            @csrf
                            <input type="hidden" name="type" value="property_inquiry">
                            <input type="hidden" name="property_id" value="{{ $property->id }}">
                            <input type="hidden" name="subject" value="Inquiry for {{ $property->reference_no }} - {{ $property->title }}">

                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-700 mb-1">Your Full Name *</label>
                                <input type="text" name="name" required placeholder="Dr. / Mr. / Chief..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-forest-800 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-700 mb-1">Email Address *</label>
                                <input type="email" name="email" required placeholder="name@company.com" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-forest-800 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-700 mb-1">Phone / WhatsApp *</label>
                                <input type="text" name="phone" required placeholder="0803 000 0000" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-forest-800 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-700 mb-1">Message / Inspection Request</label>
                                <textarea name="message" rows="3" required placeholder="I would like to schedule an inspection / request title verification documents for this property..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-forest-800 focus:outline-none">I am interested in acquiring/leasing this property (Ref: {{ $property->reference_no }}). Please provide full particulars and schedule an inspection.</textarea>
                            </div>

                            <button type="submit" class="w-full py-3.5 rounded-xl bg-forest-900 hover:bg-forest-800 text-white font-bold text-xs uppercase tracking-wider transition shadow-md flex items-center justify-center space-x-2">
                                <i class="fa-solid fa-paper-plane text-gold-400"></i>
                                <span>Send Inspection Request</span>
                            </button>
                        </form>

                        <!-- Surveyor Contact Box -->
                        <div class="mt-6 pt-4 border-t border-slate-100 text-center text-xs">
                            <span class="text-slate-500 block mb-1">Prefer instant telephone dispatch?</span>
                            <a href="tel:08037002395" class="text-forest-900 font-bold font-mono hover:text-gold-700 text-sm">
                                <i class="fa-solid fa-phone text-gold-600 mr-1"></i> 08037002395 (Abuja Practice Desk)
                            </a>
                            <a href="tel:08187666130" class="text-forest-900 font-bold font-mono hover:text-gold-700 text-sm block mt-1">
                                <i class="fa-solid fa-phone text-gold-600 mr-1"></i> 08187666130 (Direct Client Line)
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
