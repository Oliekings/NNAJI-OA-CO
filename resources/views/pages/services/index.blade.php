@extends('layouts.app')

@section('title', 'Professional Estate & Valuation Services | NNAJI O.A & COMPANY')

@section('content')

    <!-- Banner -->
    <section class="bg-forest-950 text-white relative overflow-hidden">
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-forest-600/[0.05] rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
            <div class="max-w-2xl" style="animation: fadeInLeft 0.7s ease-out">
                <p class="text-gold-400 text-xs font-bold uppercase tracking-[0.2em] mb-3">NIESV-Approved Scale of Charges</p>
                <h1 class="heading-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-[1.1] mb-4">
                    Professional Services
                </h1>
                <div class="section-divider-left mb-4"></div>
                <p class="text-slate-300/90 text-sm leading-relaxed">
                    Certified surveying and valuation consultancy across public, private, corporate, and agricultural sectors throughout Nigeria.
                </p>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <div class="py-20 bg-ivory-base">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach($services as $service)
                    <div class="reveal" style="--i: {{ $loop->index }}">
                        <x-service-card :service="$service" />
                    </div>
                @endforeach
            </div>

            <!-- Tech Banner -->
            <div class="mt-20 bg-white rounded-3xl p-8 sm:p-12 border border-ivory-border shadow-sm reveal-scale relative overflow-hidden">
                <div class="absolute top-0 right-0 w-48 h-48 bg-gold-100/40 rounded-full blur-3xl"></div>
                <div class="relative z-10 max-w-2xl mx-auto text-center space-y-4">
                    <p class="text-gold-700 text-xs font-bold uppercase tracking-[0.2em]">Technical Infrastructure</p>
                    <h2 class="heading-serif text-2xl sm:text-3xl font-bold text-slate-900">
                        Modern Surveying Technology
                    </h2>
                    <div class="section-divider"></div>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Our offices maintain cutting-edge equipment including <strong class="text-slate-700">Disto Digital Distance Measuring Devices</strong>, high-resolution audit cameras, AutoCAD drafting suites, and GIS mapping tools.
                    </p>
                    <div class="pt-4">
                        <a href="{{ route('request-valuation') }}" class="group inline-flex items-center gap-2 px-8 py-3.5 rounded-xl bg-forest-900 hover:bg-forest-800 text-white font-bold text-[11px] uppercase tracking-wider transition-all duration-300 shadow-md hover:shadow-lg">
                            <i class="fa-solid fa-file-invoice text-gold-400"></i> Commission a Service
                            <i class="fa-solid fa-arrow-right text-gold-400 text-[10px] transition-transform group-hover:translate-x-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
