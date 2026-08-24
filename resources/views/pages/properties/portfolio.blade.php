@extends('layouts.app')

@section('title', 'Closed Deals & Transaction Portfolio | NNAJI O.A & COMPANY')

@section('content')

    <!-- Banner -->
    <section class="bg-forest-950 text-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-80 h-80 bg-gold-400/[0.03] rounded-full blur-3xl -translate-y-1/2 -translate-x-1/3"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
            <div class="max-w-2xl" style="animation: fadeInLeft 0.7s ease-out">
                <div class="flex items-center gap-2.5 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-gold-400/10 text-gold-400 flex items-center justify-center">
                        <i class="fa-solid fa-trophy text-sm"></i>
                    </div>
                    <p class="text-gold-400 text-xs font-bold uppercase tracking-[0.2em]">Track Record & Archive</p>
                </div>
                <h1 class="heading-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-[1.1] mb-4">
                    Closed Deals & Portfolio
                </h1>
                <div class="section-divider-left mb-4"></div>
                <p class="text-slate-300/90 text-sm leading-relaxed">
                    Successfully concluded corporate transactions, landmark valuations, and property acquisitions — automatically archived through our lifecycle system.
                </p>
            </div>
        </div>
    </section>

    <!-- Metric Ribbon -->
    <div data-metrics class="bg-forest-900 py-8 border-b border-forest-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 lg:gap-12 text-center">
                <div class="reveal">
                    <span class="text-2xl lg:text-3xl font-cinzel font-bold text-gold-400">₦50B+</span>
                    <span class="block text-[10px] uppercase tracking-[0.2em] text-slate-400 mt-1">Cumulative Assets Valued</span>
                </div>
                <div class="reveal">
                    <span class="text-2xl lg:text-3xl font-cinzel font-bold text-gold-400">100+ Assets</span>
                    <span class="block text-[10px] uppercase tracking-[0.2em] text-slate-400 mt-1">Managed Nationwide</span>
                </div>
                <div class="reveal">
                    <span class="text-2xl lg:text-3xl font-cinzel font-bold text-gold-400">Institutional Grade</span>
                    <span class="block text-[10px] uppercase tracking-[0.2em] text-slate-400 mt-1">AMCON • NNPC • NIESV</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Content -->
    <div class="py-12 bg-ivory-base">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Search -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-ivory-border/80 shadow-sm mb-10 reveal-scale">
                <form action="{{ route('properties.portfolio') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-4 items-end">
                    <div class="sm:col-span-3">
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Search Transactions</label>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by asset, client (AMCON, Durbar Hotel, Wema Bank), or location..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none transition-all">
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="submit" class="w-full py-2.5 rounded-xl bg-forest-900 hover:bg-forest-800 text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 shadow-sm hover:shadow-md active:scale-[0.97] flex items-center justify-center gap-1.5">
                            <i class="fa-solid fa-search text-gold-400 text-[10px]"></i> Search
                        </button>
                        <a href="{{ route('properties.portfolio') }}" class="px-3 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-500 text-xs font-medium transition-all" title="Reset">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    </div>
                </form>
            </div>

            @if($closedDeals->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 mb-12">
                    @foreach($closedDeals as $deal)
                        <div class="reveal" style="--i: {{ $loop->index }}">
                            <x-portfolio-card :property="$deal" />
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $closedDeals->links() }}
                </div>
            @else
                <div class="bg-white rounded-2xl p-16 text-center border border-ivory-border shadow-sm reveal-scale">
                    <h3 class="text-lg font-bold text-slate-800 mb-2">No Transactions Found</h3>
                    <p class="text-slate-500 text-sm max-w-md mx-auto mb-6">
                        Modify your search to browse our extensive valuation and corporate transactions archive.
                    </p>
                    <a href="{{ route('properties.portfolio') }}" class="px-6 py-2.5 rounded-xl bg-forest-900 text-white font-bold text-xs uppercase tracking-wider inline-flex items-center gap-2 hover:bg-forest-800 transition-all">
                        Reset Search <i class="fa-solid fa-rotate-left text-gold-400"></i>
                    </a>
                </div>
            @endif

        </div>
    </div>

@endsection
