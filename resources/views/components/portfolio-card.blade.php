@props(['property'])

<div class="group card-lift bg-white rounded-2xl overflow-hidden border border-ivory-border/80 shadow-sm flex flex-col h-full">
    <!-- Image & Badges -->
    <div class="relative h-56 overflow-hidden bg-slate-900 group/img cursor-pointer" data-lightbox-src="{{ $property->display_cover ?? $property->featured_image }}" data-title="{{ $property->title }}">
        @if($property->display_cover)
            <img src="{{ $property->display_cover }}" alt="{{ $property->title }}" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110 saturate-[0.85]">
        @elseif($property->has_video)
            <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-forest-950 via-forest-900 to-forest-950 text-gold-400 p-6 text-center">
                <div class="w-12 h-12 rounded-full bg-red-600/90 text-white flex items-center justify-center mb-1 shadow-lg">
                    <i class="fa-solid fa-play text-base ml-0.5"></i>
                </div>
                <span class="text-[10px] uppercase font-bold tracking-wider text-gold-300">Video Dossier</span>
            </div>
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-forest-900/10 to-forest-800/5 text-forest-800/30">
                <i class="fa-solid fa-file-shield text-5xl"></i>
            </div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-forest-950/85 via-forest-950/20 to-transparent"></div>

        <!-- Quick Zoom Icon Button -->
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover/img:opacity-100 transition-opacity duration-300 pointer-events-none">
            <span class="px-3.5 py-1.5 rounded-full bg-forest-950/80 backdrop-blur-md text-gold-300 border border-gold-500/40 text-xs font-bold shadow-xl flex items-center gap-1.5 transform scale-90 group-hover/img:scale-100 transition-transform">
                <i class="fa-solid fa-magnifying-glass-plus text-xs"></i>
                <span>Enlarge & Zoom</span>
            </span>
        </div>

        <!-- Closed Deal Ribbon -->
        <div class="absolute top-3.5 left-3.5 z-10">
            <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-lg shadow-lg bg-red-700/90 text-white border border-red-500/30 backdrop-blur-sm flex items-center gap-1.5">
                <i class="fa-solid fa-check-circle text-gold-300 text-[9px]"></i>
                {{ $property->status === 'leased' ? 'LEASED' : ($property->status === 'valuation_closed' ? 'VALUATION COMPLETED' : 'SOLD') }}
            </span>
        </div>

        <!-- Property Type & Completion Date -->
        <div class="absolute top-3.5 right-3.5 text-right z-10">
            <span class="px-2.5 py-1 text-[10px] font-medium rounded-lg bg-forest-900/80 text-gold-300 backdrop-blur-sm border border-forest-700/30">
                {{ $property->property_type }}
            </span>
            @if($property->sold_date)
                <span class="block text-[9px] text-slate-300/80 font-mono mt-1.5">
                    {{ $property->sold_date->format('M Y') }}
                </span>
            @endif
        </div>

        <!-- Transaction Value -->
        <div class="absolute bottom-3.5 left-3.5 right-3.5 z-10">
            <div class="text-[10px] text-gold-300/80 uppercase tracking-wider font-medium mb-0.5">
                {{ $property->listing_type === 'valuation_record' ? 'Appraised Value' : 'Transaction Value' }}
            </div>
            <div class="text-lg md:text-xl font-bold text-white font-cinzel tracking-tight">
                {{ $property->formatted_sold_price ?? $property->formatted_price }}
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="p-5 flex-1 flex flex-col justify-between">
        <div>
            <!-- Location -->
            <div class="flex items-center text-[11px] font-medium text-forest-700/80 mb-2 gap-1.5">
                <i class="fa-solid fa-location-dot text-gold-600 text-[10px]"></i>
                <span class="truncate">{{ $property->location_city }}, {{ $property->location_state }}</span>
            </div>

            <!-- Title -->
            <h3 class="text-base font-bold text-slate-900 group-hover:text-forest-800 transition-colors duration-200 line-clamp-2 mb-3 leading-snug">
                <a href="{{ route('properties.show', $property->slug) }}">
                    {{ $property->title }}
                </a>
            </h3>

            <!-- Client Badge -->
            @if($property->client_name)
                <div class="mb-3 py-2 px-3 rounded-lg bg-forest-50/50 border border-forest-100/60 text-xs flex items-center gap-2">
                    <i class="fa-solid fa-building-user text-gold-600 text-[10px]"></i>
                    <span class="text-forest-800 font-medium truncate">{{ $property->client_name }}</span>
                </div>
            @endif

            @if($property->transaction_summary)
                <p class="text-slate-500 text-xs line-clamp-2 leading-relaxed mb-3">
                    {{ $property->transaction_summary }}
                </p>
            @else
                <p class="text-slate-400 text-xs line-clamp-2 leading-relaxed mb-3">
                    {{ $property->description }}
                </p>
            @endif
        </div>

        <!-- Footer -->
        <div class="pt-3 border-t border-slate-100/80 flex items-center justify-between">
            <a href="{{ route('properties.show', $property->slug) }}" class="group/link text-xs font-bold text-forest-900 hover:text-gold-700 flex items-center gap-1.5 transition-colors duration-200">
                View Dossier <i class="fa-solid fa-arrow-right text-gold-500 text-[10px] transition-transform duration-200 group-hover/link:translate-x-1"></i>
            </a>
            <span class="text-[9px] text-slate-400 font-mono">
                {{ $property->reference_no }}
            </span>
        </div>
    </div>
</div>
