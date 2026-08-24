@extends('layouts.app')

@section('title', 'Executive Leadership & Key Staff | NNAJI O.A & COMPANY')

@section('content')

    <!-- Banner -->
    <section class="bg-forest-950 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-80 h-80 bg-gold-400/[0.03] rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
            <div class="max-w-2xl" style="animation: fadeInLeft 0.7s ease-out">
                <p class="text-gold-400 text-xs font-bold uppercase tracking-[0.2em] mb-3">Fellows, Associates & Registered Surveyors</p>
                <h1 class="heading-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-[1.1] mb-4">
                    Executive Partners & Team
                </h1>
                <div class="section-divider-left mb-4"></div>
                <p class="text-slate-300/90 text-sm leading-relaxed">
                    Our multi-disciplinary team brings together seasoned Fellows of NIESV, Registered Surveyors, facility managers, and specialized valuation engineers with deep institutional experience.
                </p>
            </div>
        </div>
    </section>

    <!-- Team Content -->
    <div class="py-20 bg-ivory-base">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20">
            
            <!-- Partners -->
            <div>
                <div class="mb-10 reveal-left">
                    <p class="text-gold-700 text-xs font-bold uppercase tracking-[0.2em] mb-2">Senior Advisory</p>
                    <h2 class="heading-serif text-2xl sm:text-3xl font-bold text-slate-900">
                        Executive Partners
                    </h2>
                    <div class="section-divider-left mt-3"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                    @foreach($partners as $partner)
                        <div class="reveal" style="--i: {{ $loop->index }}">
                            <x-team-card :member="$partner" />
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Surveyors & Branch Heads -->
            <div>
                <div class="mb-10 reveal-left">
                    <p class="text-gold-700 text-xs font-bold uppercase tracking-[0.2em] mb-2">Field Operations</p>
                    <h2 class="heading-serif text-2xl sm:text-3xl font-bold text-slate-900">
                        Branch Managers & Surveyors
                    </h2>
                    <div class="section-divider-left mt-3"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($surveyors as $surveyor)
                        <div class="reveal" style="--i: {{ $loop->index }}">
                            <x-team-card :member="$surveyor" />
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Affiliate Engineers -->
            <div class="bg-white rounded-3xl p-8 sm:p-10 border border-ivory-border shadow-sm reveal-scale relative overflow-hidden">
                <div class="absolute top-0 right-0 w-40 h-40 bg-forest-50/60 rounded-full blur-2xl"></div>
                <div class="relative z-10">
                    <h3 class="heading-serif text-xl font-bold text-slate-900 mb-2">
                        Affiliated Engineering Consultants
                    </h3>
                    <div class="section-divider-left mb-4"></div>
                    <p class="text-slate-500 text-sm mb-8 max-w-xl">
                        Complementary technical expertise deployed on complex plant, machinery, civil structures, and road compensation surveys.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        @foreach([
                            ['name' => 'Engineer Uche Nnaji', 'title' => 'COREN, ACA (Mechanical)', 'desc' => 'Ex-Nigerian Breweries Engineering Manager. Plant machinery rehabilitation & industrial installation audits.'],
                            ['name' => 'Obadire Agomah', 'title' => 'Affiliate Civil Engineer', 'desc' => 'Inspector on Escravos GTL, Bonny Island Terminal, and Indorama Eleme Petrochemicals.'],
                            ['name' => 'Ikemefuna Ifeacho', 'title' => 'B.Sc, ANIQS (Quantity Surveyor)', 'desc' => 'Bills of quantities, construction cost verification, and road infrastructure valuation.'],
                        ] as $i => $eng)
                            <div class="card-lift p-5 rounded-xl bg-ivory-alt/50 border border-ivory-border/60 relative overflow-hidden" style="--i: {{ $i }}">
                                <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-gold-400 to-gold-500/20 rounded-r"></div>
                                <div class="pl-3">
                                    <strong class="text-forest-950 block text-sm mb-0.5">{{ $eng['name'] }}</strong>
                                    <span class="text-gold-700 font-semibold text-[11px]">{{ $eng['title'] }}</span>
                                    <p class="text-slate-500 text-[11px] pt-2 leading-relaxed">{{ $eng['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
