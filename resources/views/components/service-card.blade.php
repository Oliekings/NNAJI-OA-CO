@props(['service'])

<div class="group card-lift bg-white rounded-2xl p-7 border border-ivory-border/80 shadow-sm flex flex-col justify-between h-full relative overflow-hidden">
    <!-- Hover accent gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-gold-50/0 via-transparent to-forest-50/0 group-hover:from-gold-50/60 group-hover:to-forest-50/30 transition-all duration-500 rounded-2xl"></div>
    
    <div class="relative z-10">
        <!-- Icon & Number -->
        <div class="flex items-center justify-between mb-6">
            <div class="w-12 h-12 rounded-xl bg-forest-900 text-gold-400 flex items-center justify-center text-xl shadow-sm group-hover:bg-gold-500 group-hover:text-forest-950 transition-all duration-400 group-hover:rotate-3 group-hover:scale-110">
                <i class="fa-solid {{ $service->icon ?? 'fa-landmark' }}"></i>
            </div>
            <span class="text-4xl font-cinzel font-bold text-slate-100 group-hover:text-gold-200/50 transition-colors duration-400 select-none">
                0{{ $service->sort_order }}
            </span>
        </div>

        <!-- Title & Subtitle -->
        <h3 class="text-lg font-bold text-slate-900 mb-1.5 group-hover:text-forest-800 transition-colors leading-snug">
            <a href="{{ route('services.show', $service->slug) }}">
                {{ $service->title }}
            </a>
        </h3>
        @if($service->subtitle)
            <div class="text-[11px] font-semibold text-gold-700/80 uppercase tracking-wider mb-3">
                {{ $service->subtitle }}
            </div>
        @endif

        <div class="w-8 h-[2px] bg-gold-400/40 mb-4 group-hover:w-12 transition-all duration-300"></div>

        <!-- Description -->
        <p class="text-slate-500 text-sm leading-relaxed mb-6">
            {{ $service->short_description }}
        </p>

        <!-- Scope Highlights -->
        @if(!empty($service->scope_of_work) && is_array($service->scope_of_work))
            <div class="space-y-2 mb-6">
                @foreach(array_slice($service->scope_of_work, 0, 3) as $scope)
                    <div class="flex items-start text-xs text-slate-600 gap-2">
                        <i class="fa-solid fa-check text-gold-500 mt-0.5 flex-shrink-0"></i>
                        <span>{{ $scope }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Action Link -->
    <div class="relative z-10 pt-4 border-t border-slate-100/80 flex items-center justify-between">
        <a href="{{ route('services.show', $service->slug) }}" class="group/link text-xs font-bold text-forest-900 hover:text-gold-700 flex items-center gap-1.5 transition-colors duration-200">
            Learn More <i class="fa-solid fa-arrow-right text-gold-500 text-[10px] transition-transform duration-200 group-hover/link:translate-x-1"></i>
        </a>
        <a href="{{ route('request-valuation') }}" class="text-[11px] text-slate-400 hover:text-forest-900 transition-colors duration-200">
            Get Quote
        </a>
    </div>
</div>
