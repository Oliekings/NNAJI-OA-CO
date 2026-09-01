@props(['property'])

<div class="group card-lift bg-white rounded-2xl overflow-hidden border border-ivory-border/80 shadow-sm flex flex-col h-full">
    <!-- Property Image & Status Badges -->
    <div class="relative h-60 overflow-hidden bg-slate-900 group/img cursor-pointer" data-lightbox-src="{{ $property->display_cover ?? $property->featured_image }}" data-title="{{ $property->title }}">
        @if($property->display_cover)
            <img src="{{ $property->display_cover }}" alt="{{ $property->title }}" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
        @elseif($property->has_video)
            <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-forest-950 via-forest-900 to-forest-950 text-gold-400 p-6 text-center">
                <div class="w-14 h-14 rounded-full bg-red-600/90 text-white flex items-center justify-center mb-2 shadow-lg group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-play text-lg ml-0.5"></i>
                </div>
                <span class="text-[11px] uppercase font-bold tracking-wider text-gold-300">Video Tour Available</span>
            </div>
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-forest-900/10 to-forest-800/5 text-forest-800/40">
                <i class="fa-solid fa-building text-5xl"></i>
            </div>
        @endif
        
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-forest-950/80 via-forest-950/10 to-transparent"></div>

        <!-- Quick Zoom Icon Button -->
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover/img:opacity-100 transition-opacity duration-300 pointer-events-none">
            <span class="px-3.5 py-1.5 rounded-full bg-forest-950/80 backdrop-blur-md text-gold-300 border border-gold-500/40 text-xs font-bold shadow-xl flex items-center gap-1.5 transform scale-90 group-hover/img:scale-100 transition-transform">
                @if($property->has_video)
                    <i class="fa-solid fa-circle-play text-xs text-red-400"></i>
                    <span>Watch Video Tour</span>
                @else
                    <i class="fa-solid fa-magnifying-glass-plus text-xs"></i>
                    <span>Quick View & Zoom</span>
                @endif
            </span>
        </div>

        <!-- Listing Type & Video Badge -->
        <div class="absolute top-3.5 left-3.5 flex flex-col gap-1.5 z-10">
            <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-lg shadow-lg bg-forest-900/90 text-gold-300 border border-gold-500/30 backdrop-blur-sm">
                {{ str_replace('_', ' ', strtoupper($property->listing_type)) }}
            </span>
            @if($property->has_video)
                <span class="px-2.5 py-0.5 text-[9px] font-bold uppercase tracking-wider rounded-md shadow bg-red-600/95 text-white flex items-center gap-1">
                    <i class="fa-solid fa-video text-[8px]"></i> Video
                </span>
            @endif
            @if($property->is_featured)
                <span class="px-2.5 py-0.5 text-[9px] font-bold uppercase tracking-wider rounded-md shadow bg-gold-400 text-forest-950">
                    <i class="fa-solid fa-star text-[8px] mr-0.5"></i> Featured
                </span>
            @endif
        </div>

        <!-- Property Type -->
        <div class="absolute top-3.5 right-3.5 z-10">
            <span class="px-2.5 py-1 text-[10px] font-semibold rounded-lg bg-white/90 backdrop-blur-sm text-slate-700 shadow-sm">
                {{ $property->property_type }}
            </span>
        </div>

        <!-- Price Tag -->
        <div class="absolute bottom-3.5 left-3.5 right-3.5 flex items-end justify-between z-10">
            <div>
                <span class="text-[10px] uppercase text-gold-300/80 font-medium tracking-wider block mb-0.5">Price</span>
                <span class="text-xl font-bold text-white font-cinzel tracking-tight">
                    {{ $property->formatted_price }}
                </span>
            </div>
            @if($property->reference_no)
                <span class="text-[9px] text-slate-400 font-mono bg-black/30 backdrop-blur-sm px-2 py-0.5 rounded">
                    {{ $property->reference_no }}
                </span>
            @endif
        </div>
    </div>

    <!-- Content & Specs -->
    <div class="p-5 flex-1 flex flex-col justify-between">
        <div>
            <!-- Location -->
            <div class="flex items-center text-[11px] font-medium text-forest-700/80 mb-2 gap-1.5">
                <i class="fa-solid fa-location-dot text-gold-600 text-[10px]"></i>
                <span class="truncate">{{ $property->location_address ? $property->location_address . ', ' : '' }}{{ $property->location_city }}, {{ $property->location_state }}</span>
            </div>

            <!-- Title -->
            <h3 class="text-base font-bold text-slate-900 group-hover:text-forest-800 transition-colors duration-200 line-clamp-2 mb-3 leading-snug">
                <a href="{{ route('properties.show', $property->slug) }}">
                    {{ $property->title }}
                </a>
            </h3>

            <!-- Key Specs -->
            <div class="flex items-center gap-3 py-2.5 border-y border-slate-100/80 text-[11px] text-slate-500 mb-3">
                @if($property->bedrooms)
                    <div class="flex items-center gap-1">
                        <i class="fa-solid fa-bed text-gold-500/70 text-[10px]"></i>
                        <span>{{ $property->bedrooms }} Beds</span>
                    </div>
                @endif
                @if($property->bathrooms)
                    <div class="flex items-center gap-1">
                        <i class="fa-solid fa-bath text-gold-500/70 text-[10px]"></i>
                        <span>{{ $property->bathrooms }} Baths</span>
                    </div>
                @endif
                @if($property->land_area)
                    <div class="flex items-center gap-1 truncate">
                        <i class="fa-solid fa-ruler-combined text-gold-500/70 text-[10px]"></i>
                        <span class="truncate">{{ $property->land_area }}</span>
                    </div>
                @elseif($property->building_area)
                    <div class="flex items-center gap-1 truncate">
                        <i class="fa-solid fa-building text-gold-500/70 text-[10px]"></i>
                        <span class="truncate">{{ $property->building_area }}</span>
                    </div>
                @else
                    <div class="flex items-center gap-1">
                        <i class="fa-solid fa-shield-check text-gold-500/70 text-[10px]"></i>
                        <span>Verified</span>
                    </div>
                @endif
            </div>

            <!-- Snippet -->
            <p class="text-slate-400 text-xs line-clamp-2 leading-relaxed mb-3">
                {{ $property->description }}
            </p>
        </div>

        <!-- Action -->
        <div class="pt-3 flex items-center justify-between border-t border-slate-100/80">
            <a href="{{ route('properties.show', $property->slug) }}" class="group/link text-xs font-bold text-forest-900 hover:text-gold-700 flex items-center gap-1.5 transition-colors duration-200">
                View Details <i class="fa-solid fa-arrow-right text-gold-500 text-[10px] transition-transform duration-200 group-hover/link:translate-x-1"></i>
            </a>
            <a href="{{ route('request-valuation', ['property_id' => $property->id]) }}" class="text-[10px] font-medium text-slate-400 hover:text-gold-700 transition-colors duration-200">
                Schedule Inspection
            </a>
        </div>
    </div>
</div>
