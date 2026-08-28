@extends('layouts.app')

@section('title', $service->title . ' | NNAJI O.A & COMPANY')

@section('content')

    <!-- Header Banner -->
    <div class="bg-forest-950 text-white py-16 border-b border-gold-500/30 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl space-y-3">
                <div class="flex items-center space-x-2 text-xs text-slate-300">
                    <a href="{{ route('home') }}" class="hover:text-gold-400">Home</a>
                    <span>/</span>
                    <a href="{{ route('services.index') }}" class="hover:text-gold-400">Services</a>
                    <span>/</span>
                    <span class="text-gold-300">{{ $service->title }}</span>
                </div>
                <h1 class="heading-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-white">
                    {{ $service->title }}
                </h1>
                @if($service->subtitle)
                    <p class="text-gold-300 text-base font-semibold">
                        {{ $service->subtitle }}
                    </p>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Service Body -->
    <div class="py-16 bg-ivory-base">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Main Content (8 cols) -->
                <div class="lg:col-span-8 space-y-10">
                    
                    <!-- Full Description -->
                    <div class="bg-white rounded-3xl p-8 sm:p-10 border border-ivory-border shadow-sm space-y-4">
                        <h2 class="heading-serif text-2xl font-bold text-slate-900">
                            Professional Scope & Methodology
                        </h2>
                        <div class="text-slate-700 text-sm leading-relaxed whitespace-pre-line">
                            {{ $service->full_description }}
                        </div>
                    </div>

                    <!-- Scope of Work Detailed -->
                    @if(!empty($service->scope_of_work) && is_array($service->scope_of_work))
                        <div class="bg-white rounded-3xl p-8 sm:p-10 border border-ivory-border shadow-sm">
                            <h3 class="heading-serif text-xl font-bold text-slate-900 mb-6">
                                Key Mandates & Execution Areas
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($service->scope_of_work as $scope)
                                    <div class="flex items-start p-4 rounded-xl bg-forest-50/60 border border-forest-100 text-xs text-slate-800">
                                        <i class="fa-solid fa-check-circle text-emerald-600 mt-0.5 mr-3 text-sm flex-shrink-0"></i>
                                        <span class="font-medium">{{ $scope }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Asset Classes Covered -->
                    @if(!empty($service->asset_classes) && is_array($service->asset_classes))
                        <div class="bg-white rounded-3xl p-8 sm:p-10 border border-ivory-border shadow-sm">
                            <h3 class="heading-serif text-xl font-bold text-slate-900 mb-6">
                                Asset Classes & Sectors Covered
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($service->asset_classes as $assetClass)
                                    <div class="flex items-center p-3.5 rounded-xl bg-slate-50 border border-slate-100 text-xs text-slate-700">
                                        <i class="fa-solid fa-layer-group text-gold-600 mr-2.5"></i>
                                        <span>{{ $assetClass }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Right Sidebar (4 cols) -->
                <div class="lg:col-span-4 space-y-6">
                    
                    <!-- Commission Service Card -->
                    <div class="bg-forest-950 text-white rounded-3xl p-8 border-2 border-gold-500/40 shadow-xl sticky top-24">
                        <div class="text-center space-y-3 mb-6">
                            <div class="w-12 h-12 rounded-xl bg-gold-500 text-forest-950 flex items-center justify-center text-xl mx-auto font-bold">
                                <i class="fa-solid {{ $service->icon ?? 'fa-landmark' }}"></i>
                            </div>
                            <h3 class="heading-serif text-xl font-bold text-white">
                                Commission This Service
                            </h3>
                            <p class="text-xs text-slate-300">
                                Connect with our certified partners to execute your valuation or real estate mandate.
                            </p>
                        </div>

                        <a href="{{ route('request-valuation') }}" class="block w-full py-3.5 rounded-xl bg-gradient-to-r from-gold-500 to-gold-400 text-forest-950 text-center font-bold text-xs uppercase tracking-wider hover:from-gold-400 hover:to-gold-300 transition shadow-lg mb-4">
                            Request Service Quote / Valuation
                        </a>

                        <div class="text-center text-xs text-slate-400 space-y-2 pt-2 border-t border-forest-800">
                            <div><i class="fa-solid fa-phone text-gold-400 mr-1"></i> 08037002395 / 08187666130</div>
                            <div><i class="fa-solid fa-envelope text-gold-400 mr-1"></i> nnajioacompany@gmail.com</div>
                        </div>
                    </div>

                    <!-- Other Practice Areas -->
                    <div class="bg-white rounded-2xl p-6 border border-ivory-border shadow-sm">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-forest-900 mb-4 border-b border-slate-100 pb-2">
                            Other Practice Areas
                        </h4>
                        <div class="space-y-2 text-xs">
                            @foreach($allServices as $other)
                                <a href="{{ route('services.show', $other->slug) }}" class="flex items-center justify-between p-2 rounded-lg hover:bg-forest-50 transition text-slate-700 font-medium">
                                    <span>{{ $other->title }}</span>
                                    <i class="fa-solid fa-chevron-right text-slate-400 text-[10px]"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
