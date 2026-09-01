@extends('layouts.app')

@section('title', 'NNAJI O.A & COMPANY | Estate Surveyors & Valuers (Est. 1981)')

@section('content')

    <!-- ════════════════════════════════════════════════════════════════
         1. HERO — Full-bleed immersive hero with parallax texture
    ════════════════════════════════════════════════════════════════ -->
    <section class="relative bg-forest-950 text-white overflow-hidden min-h-[85vh] flex items-center border-b border-gold-500/20">
        <!-- Multi-layer background with dim atmospheric property imagery in shadows -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            @php
                $heroBgImage = ($featuredProperties->first() && $featuredProperties->first()->featured_image) 
                    ? $featuredProperties->first()->featured_image 
                    : asset('images/wuse-zone1-office-complex.webp');
            @endphp
            
            <!-- Real Property Asset Layer (Dimmed in shadows with soft luxury contrast) -->
            <div class="absolute inset-0 bg-forest-950">
                <img src="{{ $heroBgImage }}" 
                     alt="Commercial Property Asset" 
                     class="w-full h-full object-cover object-center scale-105 transition-transform duration-1000 ease-out opacity-35 mix-blend-luminosity brightness-[0.70] contrast-[1.25]">
            </div>

            <!-- Deep Forest Green & Gold Vignette Gradients -->
            <div class="absolute inset-0 bg-gradient-to-r from-forest-950 via-forest-950/85 to-forest-950/60"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-forest-950 via-transparent to-forest-950/75"></div>
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-gold-500/10 via-transparent to-transparent"></div>

            <!-- Subtle organic ambient glows -->
            <div class="absolute -bottom-20 -right-20 w-[600px] h-[600px] rounded-full bg-gold-400/[0.04] blur-3xl pointer-events-none"></div>
            <div class="absolute top-20 -left-40 w-[400px] h-[400px] rounded-full bg-forest-600/[0.08] blur-3xl pointer-events-none"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-0 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                
                <!-- Left Hero Copy -->
                <div class="lg:col-span-7 space-y-7" style="animation: fadeInLeft 0.8s ease-out">
                    <!-- Established Badge -->
                    <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-forest-900/60 border border-gold-500/30 backdrop-blur-sm">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-gold-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-gold-400"></span>
                        </span>
                        <span class="text-[11px] uppercase font-bold tracking-[0.2em] text-gold-300">
                            Established 1981 — 40+ Years
                        </span>
                    </div>

                    <h1 class="heading-serif text-4xl sm:text-5xl lg:text-[3.5rem] xl:text-[4rem] font-bold text-white leading-[1.1] tracking-tight">
                        Precision in<br class="hidden sm:block">
                        <span class="gold-gradient-text">Valuation.</span><br>
                        Authority in<br class="hidden sm:block">
                        <span class="gold-gradient-text">Real Estate.</span>
                    </h1>

                    <div class="section-divider-left"></div>

                    <p class="text-slate-300/90 text-base sm:text-lg leading-relaxed max-w-xl" style="font-weight: 300;">
                        Nigeria's foremost firm of Registered Estate Surveyors & Valuers. Certified asset appraisals, commercial property management, and strategic advisory for financial institutions, corporations & government.
                    </p>

                    <!-- CTAs -->
                    <div class="pt-1 flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                        <a href="{{ route('request-valuation') }}" class="px-8 py-4 rounded-xl bg-gradient-to-r from-gold-500 to-gold-400 text-forest-950 font-bold text-[11px] uppercase tracking-[0.15em] hover:from-gold-400 hover:to-gold-300 transition-all duration-300 text-center shadow-lg hover:shadow-gold hover:scale-[1.02] active:scale-[0.98]">
                            <i class="fa-solid fa-file-signature mr-2"></i> Request Valuation
                        </a>
                        <a href="{{ route('properties.index') }}" class="px-8 py-4 rounded-xl bg-white/[0.06] hover:bg-white/[0.12] text-white border border-white/[0.15] font-semibold text-[11px] uppercase tracking-[0.15em] transition-all duration-300 text-center backdrop-blur-sm hover:border-gold-400/40">
                            <i class="fa-solid fa-building-circle-check mr-2 text-gold-400"></i> Browse Properties
                        </a>
                    </div>

                    <!-- Regulatory Trust Badges -->
                    <div class="pt-3 flex flex-wrap items-center gap-3">
                        @foreach([
                            ['icon' => 'fa-certificate', 'text' => 'ESVRBON F231'],
                            ['icon' => 'fa-award', 'text' => 'NIESV Member'],
                            ['icon' => 'fa-earth-americas', 'text' => 'CASLE UK'],
                        ] as $badge)
                            <div class="flex items-center gap-1.5 bg-white/[0.05] backdrop-blur-sm px-3 py-1.5 rounded-lg border border-white/[0.08] text-xs text-slate-300/80">
                                <i class="fa-solid {{ $badge['icon'] }} text-gold-400/80 text-[10px]"></i>
                                <span>{{ $badge['text'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right — Property Search Card -->
                <div class="lg:col-span-5" style="animation: fadeInRight 0.8s 0.2s ease-out both">
                    <div class="rounded-2xl p-7 sm:p-8 bg-white/[0.97] text-slate-900 shadow-2xl border border-ivory-border/80 backdrop-blur-xl relative overflow-hidden">
                        <!-- Decorative corner accent -->
                        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-gold-100 to-transparent rounded-bl-[40px]"></div>
                        
                        <div class="relative z-10">
                            <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-200/80">
                                <div>
                                    <h3 class="text-lg font-bold font-serif text-forest-950">Find a Property</h3>
                                    <p class="text-[11px] text-slate-500 mt-0.5">Search verified assets across Nigeria</p>
                                </div>
                                <div class="w-10 h-10 rounded-xl bg-forest-900 text-gold-400 flex items-center justify-center shadow-sm">
                                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                                </div>
                            </div>

                            <form action="{{ route('properties.index') }}" method="GET" class="space-y-4">
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Keywords / Reference</label>
                                    <input type="text" name="q" placeholder="e.g. Office Complex, Maitama" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:border-forest-700 focus:outline-none transition-all placeholder:text-slate-400">
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Type</label>
                                        <select name="type" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none bg-white transition-all">
                                            <option value="all">All Types</option>
                                            <option value="Commercial">Commercial</option>
                                            <option value="Residential">Residential</option>
                                            <option value="Industrial">Industrial</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Listing</label>
                                        <select name="listing_type" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none bg-white transition-all">
                                            <option value="all">All</option>
                                            <option value="for_sale">For Sale</option>
                                            <option value="for_lease">For Lease</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Location</label>
                                    <select name="location" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none bg-white transition-all">
                                        <option value="">All Locations</option>
                                        <option value="Abuja">Abuja FCT</option>
                                        <option value="Kaduna">Kaduna State</option>
                                        <option value="Abia">Abia State</option>
                                        <option value="Port Harcourt">Port Harcourt</option>
                                    </select>
                                </div>

                                <button type="submit" class="w-full py-3.5 rounded-xl bg-forest-900 hover:bg-forest-800 text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 flex items-center justify-center gap-2 shadow-md hover:shadow-lg active:scale-[0.98]">
                                    <i class="fa-solid fa-arrow-right text-gold-400"></i>
                                    <span>Search Properties</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Bottom wave separator -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="w-full h-[40px]">
                <path d="M0 60L48 52C96 44 192 28 288 22C384 16 480 20 576 28C672 36 768 48 864 48C960 48 1056 36 1152 28C1248 20 1344 16 1392 14L1440 12V60H1392C1344 60 1248 60 1152 60C1056 60 960 60 864 60C768 60 672 60 576 60C480 60 384 60 288 60C192 60 96 60 48 60H0Z" fill="#0a2a1e"/>
            </svg>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
         2. ANIMATED METRICS — Counter-up bar
    ════════════════════════════════════════════════════════════════ -->
    <section data-metrics class="bg-forest-900 py-12 text-white relative">
        <div class="absolute inset-0 opacity-[0.04]" style="background-image: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Ccircle cx=\'10\' cy=\'10\' r=\'1\' fill=\'%23d4af37\'/%3E%3C/svg%3E');"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 lg:gap-12">
                
                <div class="text-center reveal p-4">
                    <div class="text-3xl sm:text-4xl lg:text-5xl font-cinzel font-bold text-gold-400 mb-2" data-count="50" data-prefix="₦" data-suffix="B+">₦0</div>
                    <div class="text-[10px] uppercase font-bold tracking-[0.2em] text-slate-400">Assets Valued</div>
                    <div class="section-divider mt-3 mx-auto" style="width: 30px;"></div>
                </div>

                <div class="text-center reveal p-4">
                    <div class="text-3xl sm:text-4xl lg:text-5xl font-cinzel font-bold text-gold-400 mb-2" data-count="40" data-suffix="+">0</div>
                    <div class="text-[10px] uppercase font-bold tracking-[0.2em] text-slate-400">Years of Practice</div>
                    <div class="section-divider mt-3 mx-auto" style="width: 30px;"></div>
                </div>

                <div class="text-center reveal p-4">
                    <div class="text-3xl sm:text-4xl lg:text-5xl font-cinzel font-bold text-gold-400 mb-2" data-count="100" data-suffix="+">0</div>
                    <div class="text-[10px] uppercase font-bold tracking-[0.2em] text-slate-400">Properties Managed</div>
                    <div class="section-divider mt-3 mx-auto" style="width: 30px;"></div>
                </div>

                <div class="text-center reveal p-4">
                    <div class="text-3xl sm:text-4xl lg:text-5xl font-cinzel font-bold text-gold-400 mb-2" data-count="4" data-suffix=" Offices">0</div>
                    <div class="text-[10px] uppercase font-bold tracking-[0.2em] text-slate-400">Nationwide Network</div>
                    <div class="section-divider mt-3 mx-auto" style="width: 30px;"></div>
                </div>

            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
         3. PRACTICE SERVICES — Asymmetric layout, not the same grid
    ════════════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-ivory-base relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="max-w-2xl mb-16 reveal-left">
                <p class="text-gold-700 text-xs font-bold uppercase tracking-[0.2em] mb-3">What We Do</p>
                <h2 class="heading-serif text-3xl sm:text-4xl font-bold text-slate-900 mb-4">
                    Comprehensive Real Estate & Valuation Practice
                </h2>
                <div class="section-divider-left mb-4"></div>
                <p class="text-slate-600 text-[15px] leading-relaxed">
                    Executing statutory appraisals and strategic estate solutions adhering to NIESV code of practice — from single-unit residential to multi-billion naira industrial complexes.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach($services as $service)
                    <div class="reveal" style="--i: {{ $loop->index }}">
                        <x-service-card :service="$service" />
                    </div>
                @endforeach
            </div>

            <div class="mt-14 text-center reveal">
                <a href="{{ route('services.index') }}" class="group inline-flex items-center gap-2 text-sm font-semibold text-forest-900 hover:text-gold-700 transition-colors duration-300">
                    View All Services 
                    <i class="fa-solid fa-arrow-right text-gold-500 transition-transform duration-300 group-hover:translate-x-1.5"></i>
                </a>
            </div>

        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
         4. FEATURED LISTINGS — Clean, breathing layout
    ════════════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-white relative overflow-hidden">
        <!-- Subtle background texture -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-gold-100/30 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
                <div class="reveal-left">
                    <p class="text-gold-700 text-xs font-bold uppercase tracking-[0.2em] mb-3">Curated Assets</p>
                    <h2 class="heading-serif text-3xl sm:text-4xl font-bold text-slate-900 mb-3">
                        Featured Active Listings
                    </h2>
                    <div class="section-divider-left mb-4"></div>
                    <p class="text-slate-500 text-sm max-w-lg">
                        Verified commercial, residential & industrial properties from institutional clients.
                    </p>
                </div>
                <div class="reveal-right">
                    <a href="{{ route('properties.index') }}" class="group inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-forest-900 hover:bg-forest-800 text-white text-[11px] font-bold uppercase tracking-wider transition-all duration-300 shadow-sm hover:shadow-md">
                        All Listings ({{ $activePropertiesCount }}) 
                        <i class="fa-solid fa-arrow-right text-gold-400 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredProperties as $property)
                    <div class="reveal" style="--i: {{ $loop->index }}">
                        <x-property-card :property="$property" />
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
         5. CLOSED DEALS — Dark showcase with visual drama
    ════════════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-forest-950 text-white relative overflow-hidden">
        <!-- Ambient orbs -->
        <div class="absolute top-1/2 left-0 w-80 h-80 bg-gold-400/[0.03] rounded-full blur-3xl -translate-y-1/2 -translate-x-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-forest-600/[0.05] rounded-full blur-3xl translate-y-1/3 translate-x-1/3"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
                <div class="reveal-left">
                    <p class="text-gold-400 text-xs font-bold uppercase tracking-[0.2em] mb-3">Track Record</p>
                    <h2 class="heading-serif text-3xl sm:text-4xl font-bold text-white mb-3">
                        Closed Deals & Portfolio
                    </h2>
                    <div class="section-divider-left mb-4"></div>
                    <p class="text-slate-400 text-sm max-w-lg">
                        Completed transactions automatically archived from our property lifecycle system — a permanent record of institutional trust.
                    </p>
                </div>
                <div class="reveal-right">
                    <a href="{{ route('properties.portfolio') }}" class="group inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-gold-500 to-gold-400 text-forest-950 text-[11px] font-bold uppercase tracking-wider hover:from-gold-400 hover:to-gold-300 transition-all duration-300 shadow-lg hover:shadow-gold">
                        Full Archive ({{ $closedDealsCount }}+) 
                        <i class="fa-solid fa-arrow-right transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($spotlightClosedDeals as $deal)
                    <div class="reveal" style="--i: {{ $loop->index }}">
                        <x-portfolio-card :property="$deal" />
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
         6. PRINCIPAL PARTNER — Magazine editorial layout
    ════════════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-ivory-alt relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                
                <!-- Partner Image -->
                <div class="lg:col-span-5 reveal-left">
                    <div class="relative">
                        <!-- Decorative frame -->
                        <div class="absolute -inset-3 rounded-3xl border-2 border-gold-400/20 -z-10"></div>
                        <div class="absolute -inset-6 rounded-3xl border border-gold-400/10 -z-20"></div>
                        
                        <div class="w-full aspect-[3/4] rounded-2xl overflow-hidden shadow-2xl bg-forest-950">
                            @if($principalPartner && $principalPartner->avatar)
                                <img src="{{ str_starts_with($principalPartner->avatar, 'http') ? $principalPartner->avatar : asset($principalPartner->avatar) }}" alt="{{ $principalPartner->name }} ({{ $principalPartner->registration_no }})" class="w-full h-full object-cover object-top">
                            @else
                                <img src="{{ asset('images/team/esv-nnaji-nnamdi-ikechukwu.webp') }}" alt="ESV Nnaji Nnamdi Ikechukwu (FL1143)" class="w-full h-full object-cover object-top">
                            @endif
                        </div>
                        
                        <!-- Floating credentials card -->
                        <div class="absolute -bottom-5 -right-3 sm:right-4 bg-forest-900 text-white p-5 rounded-2xl border border-gold-500/40 shadow-xl max-w-[240px]" style="animation: float 4s ease-in-out infinite">
                            <div class="text-gold-400 font-cinzel font-bold text-[13px]">{{ $principalPartner ? strtoupper($principalPartner->name) : 'ESV NNAJI NNAMDI I.' }}</div>
                            <div class="text-slate-300 text-[11px] mt-0.5">{{ $principalPartner->cadre ?? 'FNIVS, RSV' }} ({{ $principalPartner->registration_no ?? 'FL1143' }})</div>
                            <div class="shimmer-line mt-2 rounded"></div>
                            <p class="text-[10px] text-slate-300 mt-2 font-medium">{{ $principalPartner->designation ?? 'Principal Partner & Head of Practice' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Biography -->
                <div class="lg:col-span-7 space-y-6 lg:pl-4 reveal-right">
                    <p class="text-gold-700 text-xs font-bold uppercase tracking-[0.2em]">Distinguished Leadership</p>
                    
                    <h2 class="heading-serif text-3xl sm:text-4xl font-bold text-slate-900 leading-[1.2]">
                        Four Decades of Principled Surveying & Dynamic Leadership
                    </h2>
                    <div class="section-divider-left"></div>

                    <p class="text-slate-600 text-[15px] leading-relaxed">
                        Under the leadership of <strong class="text-slate-900">ESV Nnaji Nnamdi Ikechukwu (FL1143)</strong> (B.Tech FUT Minna, FNIVS, RSV), NNAJI O.A & COMPANY advances into a modern era of precision valuation and corporate real estate advisory. The firm proudly upholds the pioneering heritage, professional discipline, and uncompromising ethics established by its late founder, <strong class="text-slate-900">Chief Ogwuegbu Agomoh Nnaji</strong> (FNIVS, RSV).
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div class="card-lift bg-white p-5 rounded-xl border border-ivory-border shadow-sm">
                            <div class="w-9 h-9 rounded-lg bg-gold-100 text-gold-700 flex items-center justify-center mb-3">
                                <i class="fa-solid fa-award"></i>
                            </div>
                            <h4 class="font-bold text-xs uppercase tracking-wider text-forest-900 mb-1.5">EMSA Award of Excellence</h4>
                            <p class="text-slate-500 text-xs leading-relaxed">Honoured with the Award of Excellence by the Estate Management Student Association (EMSA), Abia State Polytechnic.</p>
                        </div>
                        <div class="card-lift bg-white p-5 rounded-xl border border-ivory-border shadow-sm">
                            <div class="w-9 h-9 rounded-lg bg-gold-100 text-gold-700 flex items-center justify-center mb-3">
                                <i class="fa-solid fa-gavel"></i>
                            </div>
                            <h4 class="font-bold text-xs uppercase tracking-wider text-forest-900 mb-1.5">Judicial Commendation & Legacy</h4>
                            <p class="text-slate-500 text-xs leading-relaxed">Enduring foundation commended by the Justice I. Hwande Judicial Commission and NIESV honours.</p>
                        </div>
                    </div>

                    <div class="pt-2 flex flex-wrap items-center gap-4">
                        <a href="{{ route('team.index') }}" class="group inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-forest-900 hover:bg-forest-800 text-white text-[11px] font-bold uppercase tracking-wider transition-all duration-300 shadow-sm hover:shadow-md">
                            Meet the Partners 
                            <i class="fa-solid fa-arrow-right text-gold-400 transition-transform group-hover:translate-x-1"></i>
                        </a>
                        <a href="{{ route('about') }}" class="text-[13px] font-semibold text-forest-900 hover:text-gold-700 transition-colors duration-300 underline decoration-gold-400/30 underline-offset-4 hover:decoration-gold-400">
                            Firm History & Organogram
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
         7. VALUATION REQUEST — Warm, inviting CTA block
    ════════════════════════════════════════════════════════════════ -->
    <section class="py-24 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 reveal-scale">
            <div class="bg-forest-950 rounded-3xl p-8 sm:p-12 text-white shadow-2xl relative overflow-hidden">
                <!-- Background texture -->
                <div class="absolute inset-0 opacity-[0.04]" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23d4af37\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-gold-400/[0.05] rounded-full blur-3xl"></div>
                
                <div class="relative z-10">
                    <div class="max-w-2xl mx-auto text-center space-y-4 mb-10">
                        <p class="text-gold-400 text-xs font-bold uppercase tracking-[0.2em]">Direct Institutional Intake</p>
                        <h2 class="heading-serif text-3xl sm:text-4xl font-bold text-white">
                            Commission an Asset Valuation
                        </h2>
                        <div class="section-divider"></div>
                        <p class="text-slate-400 text-sm">
                            Submit details regarding your property, plant machinery, or portfolio. A registered partner will respond within 24 hours.
                        </p>
                    </div>

                    <form action="{{ route('inquiry.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="hidden" name="type" value="valuation_request">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-gold-300/80 mb-1.5">Full Name *</label>
                                <input type="text" name="name" required placeholder="e.g. Dr. Aminu Bello" class="w-full px-4 py-3 rounded-xl bg-forest-900/60 border border-forest-700/50 text-white placeholder-slate-500 text-sm focus:ring-2 focus:ring-gold-400/50 focus:border-gold-400/50 focus:outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-gold-300/80 mb-1.5">Organization</label>
                                <input type="text" name="organization" placeholder="e.g. Apex Energy Holding" class="w-full px-4 py-3 rounded-xl bg-forest-900/60 border border-forest-700/50 text-white placeholder-slate-500 text-sm focus:ring-2 focus:ring-gold-400/50 focus:border-gold-400/50 focus:outline-none transition-all">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-gold-300/80 mb-1.5">Email *</label>
                                <input type="email" name="email" required placeholder="name@company.com" class="w-full px-4 py-3 rounded-xl bg-forest-900/60 border border-forest-700/50 text-white placeholder-slate-500 text-sm focus:ring-2 focus:ring-gold-400/50 focus:border-gold-400/50 focus:outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-gold-300/80 mb-1.5">Phone *</label>
                                <input type="text" name="phone" required placeholder="0803 000 0000" class="w-full px-4 py-3 rounded-xl bg-forest-900/60 border border-forest-700/50 text-white placeholder-slate-500 text-sm focus:ring-2 focus:ring-gold-400/50 focus:border-gold-400/50 focus:outline-none transition-all">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-gold-300/80 mb-1.5">Service</label>
                                <select name="service_category" class="w-full px-3 py-3 rounded-xl bg-forest-900/60 border border-forest-700/50 text-white text-sm focus:ring-2 focus:ring-gold-400/50 focus:outline-none transition-all">
                                    <option value="Property & Asset Valuation">Property & Asset Valuation</option>
                                    <option value="Plant & Machinery Appraisal">Plant & Machinery</option>
                                    <option value="Facility & Property Management">Facility Management</option>
                                    <option value="Feasibility & Viability Appraisal">Feasibility Study</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-gold-300/80 mb-1.5">Asset Category</label>
                                <select name="asset_type" class="w-full px-3 py-3 rounded-xl bg-forest-900/60 border border-forest-700/50 text-white text-sm focus:ring-2 focus:ring-gold-400/50 focus:outline-none transition-all">
                                    <option value="Commercial High-Rise / Office">Commercial / Office</option>
                                    <option value="Industrial Plant / Factory">Industrial Plant</option>
                                    <option value="Oil & Gas / Tank Farm / Marine">Oil & Gas / Marine</option>
                                    <option value="Residential Estate / Land">Residential / Land</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-gold-300/80 mb-1.5">Branch</label>
                                <select name="preferred_branch" class="w-full px-3 py-3 rounded-xl bg-forest-900/60 border border-forest-700/50 text-white text-sm focus:ring-2 focus:ring-gold-400/50 focus:outline-none transition-all">
                                    <option value="Kaduna Operational Head Office">Kaduna HQ</option>
                                    <option value="Abuja Regional Office">Abuja</option>
                                    <option value="Abia State Branch">Abia State</option>
                                    <option value="USA Link Desk (Detroit)">USA Desk</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-gold-300/80 mb-1.5">Brief Description *</label>
                            <textarea name="message" rows="3" required placeholder="Provide asset location, approximate size, and appraisal objective..." class="w-full px-4 py-3 rounded-xl bg-forest-900/60 border border-forest-700/50 text-white placeholder-slate-500 text-sm focus:ring-2 focus:ring-gold-400/50 focus:outline-none transition-all resize-none"></textarea>
                        </div>

                        <div class="pt-2 text-center">
                            <button type="submit" class="w-full sm:w-auto px-10 py-4 rounded-xl bg-gradient-to-r from-gold-500 to-gold-400 text-forest-950 font-bold text-[11px] uppercase tracking-[0.15em] hover:from-gold-400 hover:to-gold-300 transition-all duration-300 shadow-xl hover:shadow-gold hover:scale-[1.02] active:scale-[0.98] inline-flex items-center justify-center gap-2">
                                <i class="fa-solid fa-paper-plane"></i> Submit Valuation Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
