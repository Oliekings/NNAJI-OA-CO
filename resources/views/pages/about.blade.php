@extends('layouts.app')

@section('title', 'About Us & Corporate History | NNAJI O.A & COMPANY')

@section('content')

    <!-- Hero Banner — Split asymmetric -->
    <section class="bg-forest-950 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Ccircle cx=\'10\' cy=\'10\' r=\'1\' fill=\'%23d4af37\'/%3E%3C/svg%3E');"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-gold-400/[0.03] rounded-full blur-3xl translate-y-1/2 translate-x-1/3"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24">
            <div class="max-w-3xl" style="animation: fadeInLeft 0.7s ease-out">
                <p class="text-gold-400 text-xs font-bold uppercase tracking-[0.2em] mb-4">Est. March 3rd, 1981</p>
                <h1 class="heading-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-[1.1] mb-5">
                    Four Decades of Estate Surveying Excellence
                </h1>
                <div class="section-divider-left mb-5"></div>
                <p class="text-slate-300/90 text-[15px] leading-relaxed max-w-2xl">
                    Recognized and approved in 1981 by the Nigerian Institution of Estate Surveyors and Valuers (NIESV) and the Estate Surveyors and Valuers Registration Board of Nigeria (ESVRBON).
                </p>
            </div>
        </div>
    </section>

    <!-- Content -->
    <div class="py-20 bg-ivory-base">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20">
            
            <!-- 1. Overview + Affiliations -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                <div class="lg:col-span-7 space-y-6 reveal-left">
                    <p class="text-gold-700 text-xs font-bold uppercase tracking-[0.2em]">Corporate Overview</p>
                    <h2 class="heading-serif text-2xl sm:text-3xl font-bold text-slate-900">
                        The Firm of NNAJI O.A & COMPANY
                    </h2>
                    <div class="section-divider-left"></div>
                    <p class="text-slate-600 text-[15px] leading-relaxed">
                        <strong class="text-slate-800">NNAJI O.A & COMPANY</strong> was accorded recognition and approval on <strong>3rd March, 1981</strong> under the Registration of Business Names Act 1961 to practice Estate Surveying and Valuation throughout the Federal Republic of Nigeria.
                    </p>
                    <p class="text-slate-600 text-[15px] leading-relaxed">
                        With operational Head Office in Kaduna and strategic branches in Abuja, Abia State, and an international link desk in Detroit, Michigan (USA), our firm has developed a reputation for unmatched precision, ethical rigor, and robust technical competency in high-stakes asset valuation.
                    </p>

                    <!-- Statutory Compliance -->
                    <div class="bg-white p-6 rounded-2xl border border-ivory-border shadow-sm mt-4">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-forest-900 mb-4 flex items-center gap-2">
                            <span class="w-5 h-[2px] bg-gold-400"></span> Statutory Registrations
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach([
                                ['label' => 'CAC Reg No', 'value' => '424962'],
                                ['label' => 'ESVRBON No', 'value' => 'F231'],
                                ['label' => 'PENCOM No', 'value' => 'LWFIRMOO1828'],
                                ['label' => 'TIN No', 'value' => '1022906307'],
                                ['label' => 'ITF Reg No', 'value' => 'KAD-0054226'],
                                ['label' => 'VAT Reg', 'value' => '01708003-0001'],
                            ] as $reg)
                                <div class="bg-ivory-alt/60 p-3 rounded-xl border border-ivory-border/60 text-xs">
                                    <span class="text-[10px] text-slate-400 block uppercase tracking-wider">{{ $reg['label'] }}</span>
                                    <strong class="text-forest-900 font-mono">{{ $reg['value'] }}</strong>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 reveal-right">
                    <div class="bg-forest-950 text-white p-8 rounded-2xl border border-gold-500/20 shadow-xl space-y-6 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gold-400/[0.05] rounded-full blur-2xl"></div>
                        <div class="relative z-10">
                            <div class="text-gold-400 font-cinzel font-bold text-base mb-1">Professional Affiliations</div>
                            <div class="section-divider-left mb-5" style="background: linear-gradient(90deg, #d4af37, transparent);"></div>
                            <ul class="space-y-5">
                                @foreach([
                                    ['icon' => 'fa-certificate', 'name' => 'NIESV', 'desc' => 'Nigerian Institution of Estate Surveyors and Valuers'],
                                    ['icon' => 'fa-shield-halved', 'name' => 'ESVRBON', 'desc' => 'Estate Surveyors and Valuers Registration Board of Nigeria'],
                                    ['icon' => 'fa-earth-americas', 'name' => 'CASLE', 'desc' => 'Commonwealth Association of Surveyors and Land Economy'],
                                    ['icon' => 'fa-landmark-flag', 'name' => 'Rating & Valuation UK', 'desc' => 'Rating and Valuation Association of Great Britain'],
                                ] as $aff)
                                    <li class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-gold-400/10 text-gold-400 flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <i class="fa-solid {{ $aff['icon'] }} text-xs"></i>
                                        </div>
                                        <div>
                                            <strong class="text-white block text-sm">{{ $aff['name'] }}</strong>
                                            <span class="text-slate-400 text-xs">{{ $aff['desc'] }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Organogram -->
            <div class="bg-white rounded-3xl p-8 sm:p-12 border border-ivory-border shadow-sm reveal-scale">
                <div class="max-w-2xl mx-auto text-center mb-10">
                    <p class="text-gold-700 text-xs font-bold uppercase tracking-[0.2em] mb-3">Governance</p>
                    <h3 class="heading-serif text-2xl sm:text-3xl font-bold text-slate-900">
                        Firm Executive Organogram
                    </h3>
                    <div class="section-divider mt-4"></div>
                </div>

                <div class="max-w-4xl mx-auto space-y-4">
                    <div class="text-center space-y-3">
                        <div class="inline-block bg-forest-950 text-gold-300 px-8 py-3 rounded-xl border border-gold-500/30 shadow-md font-bold text-sm">
                            BOARD OF PARTNERS
                        </div>
                        <div class="w-px h-6 bg-gradient-to-b from-forest-900 to-gold-400/40 mx-auto"></div>
                        <div class="inline-block bg-forest-900 text-white px-8 py-3 rounded-xl border border-gold-500/20 shadow-md font-bold text-sm">
                            PRINCIPAL PARTNER / CHIEF CONSULTANT
                        </div>
                        <div class="w-px h-6 bg-gradient-to-b from-forest-900 to-gold-400/40 mx-auto"></div>
                        <div class="inline-block bg-gradient-to-r from-gold-500 to-gold-400 text-forest-950 px-8 py-2 rounded-xl shadow-md font-bold text-xs tracking-wider">
                            BRANCH MANAGERS / PARTNERS
                        </div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 text-center text-xs mt-6">
                        @foreach(['Valuation & Inventory', 'Property & Facility Mgt', 'Agency & Acquisition', 'Investment & Development', 'Real Estate Consultancy'] as $dept)
                            <div class="card-lift p-3 bg-ivory-alt rounded-xl border border-ivory-border font-semibold text-forest-900 text-[11px]">
                                {{ $dept }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- 3. Technical Equipment -->
            <div class="reveal">
                <div class="max-w-2xl mb-10">
                    <p class="text-gold-700 text-xs font-bold uppercase tracking-[0.2em] mb-3">Data Precision</p>
                    <h3 class="heading-serif text-2xl sm:text-3xl font-bold text-slate-900 mb-3">
                        Office Instrumentation & Technical Deployment
                    </h3>
                    <div class="section-divider-left mb-4"></div>
                    <p class="text-slate-600 text-sm">
                        Each branch office is fully computerized and equipped for rapid turnaround and auditability.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach([
                        ['icon' => 'fa-ruler-horizontal', 'title' => 'Disto Laser Meters', 'desc' => 'Precision digital distance measuring equipment for architectural surveying.'],
                        ['icon' => 'fa-camera', 'title' => 'Audit Photography', 'desc' => 'High-resolution cameras for visual asset coding and inventory.'],
                        ['icon' => 'fa-laptop-code', 'title' => 'CAD & GIS Systems', 'desc' => 'Fixed asset registers, AutoCAD drafting, and spatial mapping.'],
                        ['icon' => 'fa-car-side', 'title' => 'Operational Fleet', 'desc' => 'Same-day inspection dispatch vehicles deployed nationwide.'],
                    ] as $i => $equip)
                        <div class="card-lift bg-white p-6 rounded-2xl border border-ivory-border shadow-sm" style="--i: {{ $i }}">
                            <div class="w-10 h-10 rounded-xl bg-gold-100 text-gold-700 flex items-center justify-center mb-4">
                                <i class="fa-solid {{ $equip['icon'] }}"></i>
                            </div>
                            <h4 class="font-bold text-slate-900 text-sm mb-2">{{ $equip['title'] }}</h4>
                            <p class="text-slate-500 text-xs leading-relaxed">{{ $equip['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 4. Commendations -->
            <div class="reveal">
                <div class="max-w-2xl mx-auto text-center mb-10">
                    <p class="text-gold-700 text-xs font-bold uppercase tracking-[0.2em] mb-3">Track Record</p>
                    <h3 class="heading-serif text-2xl sm:text-3xl font-bold text-slate-900">
                        Commendations & Industry Honours
                    </h3>
                    <div class="section-divider mt-4"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach([
                        ['title' => 'Judicial Commission Commendation', 'text' => 'Justice I. Hwande Commission of Inquiry: "NNAJI O.A & COMPANY rendered good stewardship... They are therefore commended."'],
                        ['title' => 'UNN Alumni Award of Excellence', 'text' => 'Chief O. A. Nnaji honoured with the 1994 Plaque of Excellence by the University of Nigeria Alumni Association.'],
                        ['title' => 'NIESV State Branch Honour', 'text' => 'Honoured with the 2007 Plaque of NIESV Kaduna State Branch for immense contributions to the profession.'],
                    ] as $i => $honour)
                        <div class="card-lift bg-white p-6 rounded-2xl border border-ivory-border shadow-sm relative overflow-hidden" style="--i: {{ $i }}">
                            <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-gold-400 to-gold-500/20 rounded-r"></div>
                            <div class="pl-4">
                                <h4 class="text-forest-900 font-bold text-sm mb-3">{{ $honour['title'] }}</h4>
                                <p class="text-slate-500 text-xs leading-relaxed italic">{{ $honour['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

@endsection
