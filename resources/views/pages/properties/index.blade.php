@extends('layouts.app')

@section('title', 'Active Property Listings | NNAJI O.A & COMPANY')

@section('content')

    <!-- Banner -->
    <section class="bg-forest-950 text-white relative overflow-hidden">
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-gold-400/[0.03] rounded-full blur-3xl translate-y-1/2 translate-x-1/3"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
            <div class="max-w-2xl" style="animation: fadeInLeft 0.7s ease-out">
                <p class="text-gold-400 text-xs font-bold uppercase tracking-[0.2em] mb-3">Corporate & Residential Real Estate</p>
                <h1 class="heading-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-[1.1] mb-4">
                    Active Property Listings
                </h1>
                <div class="section-divider-left mb-4"></div>
                <p class="text-slate-300/90 text-sm leading-relaxed">
                    Verified properties for sale and lease — directly instructed by institutional owners and vetted by our registered surveyors.
                </p>
            </div>
        </div>
    </section>

    <!-- Content -->
    <div class="py-12 bg-ivory-base">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Filter Bar -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-ivory-border/80 shadow-sm mb-10 reveal-scale">
                <form action="{{ route('properties.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Keywords</label>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Title, location, ref..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Property Type</label>
                        <select name="type" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none bg-white transition-all">
                            <option value="all">All Types</option>
                            @foreach($propertyTypes as $type)
                                <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Category</label>
                        <select name="listing_type" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none bg-white transition-all">
                            <option value="all">All Listings</option>
                            <option value="for_sale" {{ request('listing_type') == 'for_sale' ? 'selected' : '' }}>For Sale</option>
                            <option value="for_lease" {{ request('listing_type') == 'for_lease' ? 'selected' : '' }}>For Lease</option>
                            <option value="joint_venture" {{ request('listing_type') == 'joint_venture' ? 'selected' : '' }}>Joint Venture</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Location</label>
                        <select name="location" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none bg-white transition-all">
                            <option value="">All Regions</option>
                            <option value="Abuja" {{ request('location') == 'Abuja' ? 'selected' : '' }}>Abuja FCT</option>
                            <option value="Kaduna" {{ request('location') == 'Kaduna' ? 'selected' : '' }}>Kaduna</option>
                            <option value="Abia" {{ request('location') == 'Abia' ? 'selected' : '' }}>Abia State</option>
                            <option value="Lagos" {{ request('location') == 'Lagos' ? 'selected' : '' }}>Lagos</option>
                            <option value="Port Harcourt" {{ request('location') == 'Port Harcourt' ? 'selected' : '' }}>Port Harcourt</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="submit" class="w-full py-2.5 rounded-xl bg-forest-900 hover:bg-forest-800 text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 shadow-sm hover:shadow-md active:scale-[0.97] flex items-center justify-center gap-1.5">
                            <i class="fa-solid fa-search text-gold-400 text-[10px]"></i> Filter
                        </button>
                        <a href="{{ route('properties.index') }}" class="px-3 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-500 text-xs font-medium transition-all" title="Reset">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Grid -->
            @if($properties->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 mb-12">
                    @foreach($properties as $property)
                        <div class="reveal" style="--i: {{ $loop->index }}">
                            <x-property-card :property="$property" />
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $properties->links() }}
                </div>
            @else
                <div class="bg-white rounded-2xl p-16 text-center border border-ivory-border shadow-sm reveal-scale">
                    <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-300 flex items-center justify-center mx-auto mb-5 text-2xl">
                        <i class="fa-solid fa-building-circle-xmark"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">No Listings Found</h3>
                    <p class="text-slate-500 text-sm max-w-md mx-auto mb-6">
                        We have additional off-market mandates. Contact our agency desk directly for private briefs.
                    </p>
                    <a href="{{ route('contact') }}" class="px-6 py-2.5 rounded-xl bg-forest-900 text-white font-bold text-xs uppercase tracking-wider inline-flex items-center gap-2 hover:bg-forest-800 transition-all">
                        Contact Agency Desk <i class="fa-solid fa-arrow-right text-gold-400"></i>
                    </a>
                </div>
            @endif

        </div>
    </div>

@endsection
