@props(['member'])

<div class="group card-lift bg-white rounded-2xl overflow-hidden border border-ivory-border/80 shadow-sm flex flex-col h-full">
    <!-- Member Avatar -->
    <div class="relative h-64 overflow-hidden bg-forest-950">
        @if($member->avatar)
            <img src="{{ $member->avatar }}" alt="{{ $member->name }}" class="w-full h-full object-cover object-top transition-transform duration-700 ease-out group-hover:scale-110">
        @else
            <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-forest-900 via-forest-950 to-forest-900 text-gold-400 p-6 text-center">
                <div class="w-16 h-16 rounded-2xl bg-gold-400/10 border border-gold-400/30 flex items-center justify-center mb-2 shadow-inner">
                    <span class="brand-crest text-gold-300 font-bold text-lg">NOA</span>
                </div>
                <span class="text-[10px] uppercase font-bold text-gold-400/80 tracking-widest">In Memoriam</span>
            </div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-forest-950 via-forest-950/30 to-transparent"></div>

        <!-- Cadre Badge -->
        <div class="absolute top-3.5 right-3.5">
            <span class="px-3 py-1 text-[10px] font-bold rounded-lg bg-gold-400 text-forest-950 shadow-md">
                {{ $member->cadre ?? 'Estate Surveyor' }}
            </span>
        </div>

        @if($member->registration_no)
            <div class="absolute top-3.5 left-3.5">
                <span class="px-2.5 py-0.5 text-[9px] font-mono font-medium rounded-lg bg-black/40 text-gold-200/80 backdrop-blur-sm border border-gold-500/20">
                    Reg: {{ $member->registration_no }}
                </span>
            </div>
        @endif

        <!-- Name on Image -->
        <div class="absolute bottom-3.5 left-3.5 right-3.5 text-white">
            @if($member->experience_years)
                <div class="text-[10px] text-gold-300/80 uppercase tracking-wider font-medium mb-0.5">
                    {{ $member->experience_years }} Experience
                </div>
            @endif
            <h3 class="text-lg font-bold font-serif leading-tight">
                {{ $member->name }}
            </h3>
            <p class="text-[11px] text-slate-300/80 mt-0.5">{{ $member->designation }}</p>
        </div>
    </div>

    <!-- Details -->
    <div class="p-5 flex-1 flex flex-col justify-between">
        <div>
            @if($member->qualifications)
                <div class="text-[11px] text-forest-800 font-medium mb-3 bg-forest-50/50 p-2.5 rounded-lg border border-forest-100/60 flex items-center gap-1.5">
                    <i class="fa-solid fa-graduation-cap text-gold-600 text-[10px]"></i> {{ $member->qualifications }}
                </div>
            @endif

            <p class="text-slate-500 text-xs line-clamp-3 leading-relaxed mb-4">
                {{ $member->bio }}
            </p>

            @if(!empty($member->key_projects) && is_array($member->key_projects))
                <div class="space-y-1.5 mb-3">
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Key Achievements</div>
                    @foreach(array_slice($member->key_projects, 0, 2) as $feat)
                        <div class="text-[11px] text-slate-600 flex items-start gap-1.5">
                            <i class="fa-solid fa-check-double text-gold-500 text-[9px] mt-1 flex-shrink-0"></i>
                            <span class="line-clamp-1">{{ $feat }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="pt-3 border-t border-slate-100/80 flex items-center justify-between">
            <a href="{{ route('team.show', $member->slug) }}" class="group/link text-xs font-bold text-forest-900 hover:text-gold-700 flex items-center gap-1.5 transition-colors duration-200">
                Full Profile <i class="fa-solid fa-arrow-right text-gold-500 text-[10px] transition-transform duration-200 group-hover/link:translate-x-1"></i>
            </a>
            @if($member->phone)
                <a href="tel:{{ $member->phone }}" class="text-[10px] text-slate-400 hover:text-gold-700 font-mono transition-colors duration-200 flex items-center gap-1">
                    <i class="fa-solid fa-phone text-[9px]"></i> Call
                </a>
            @endif
        </div>
    </div>
</div>
