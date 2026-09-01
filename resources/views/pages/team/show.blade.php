@extends('layouts.app')

@section('title', $member->name . ' | NNAJI O.A & COMPANY')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($member->bio), 160))
@section('og_image', $member->avatar ? $member->avatar : asset('images/og-share-banner.jpg'))

@section('content')

    <!-- Header Banner -->
    <div class="bg-forest-950 text-white py-16 border-b border-gold-500/30 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl space-y-3">
                <div class="flex items-center space-x-2 text-xs text-slate-300">
                    <a href="{{ route('home') }}" class="hover:text-gold-400">Home</a>
                    <span>/</span>
                    <a href="{{ route('team.index') }}" class="hover:text-gold-400">Team</a>
                    <span>/</span>
                    <span class="text-gold-300">{{ $member->name }}</span>
                </div>
                <h1 class="heading-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-white">
                    {{ $member->name }}
                </h1>
                <p class="text-gold-300 text-sm font-semibold">
                    {{ $member->designation }} &bull; {{ $member->cadre }} ({{ $member->registration_no }})
                </p>
            </div>
        </div>
    </div>

    <!-- Main Detail -->
    <div class="py-16 bg-ivory-base">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Left Sidebar Avatar & Contact Card (4 cols) -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white rounded-3xl overflow-hidden border border-ivory-border shadow-md">
                        <div class="relative bg-forest-950 group/avatar cursor-pointer overflow-hidden {{ $member->avatar ? 'min-h-[420px] sm:min-h-[480px] flex items-center justify-center p-3' : 'h-80' }}"
                             @if($member->avatar) data-lightbox-src="{{ $member->avatar }}" data-title="{{ $member->name }} • {{ $member->designation }}" @endif>
                            @if($member->avatar)
                                <!-- Ambient portrait backdrop blur -->
                                <div class="absolute inset-0 opacity-25 blur-2xl scale-125 pointer-events-none" style="background-image: url('{{ $member->avatar }}'); background-size: cover; background-position: center;"></div>
                                
                                <!-- Fully visible uncropped portrait -->
                                <img src="{{ $member->avatar }}" alt="{{ $member->name }}" class="relative z-10 w-full h-auto max-h-[520px] object-contain rounded-2xl shadow-2xl transition-transform duration-500 group-hover/avatar:scale-[1.02]">

                                <!-- Interactive zoom indicator -->
                                <div class="absolute bottom-4 inset-x-0 flex justify-center opacity-0 group-hover/avatar:opacity-100 transition-opacity duration-300 z-20 pointer-events-none">
                                    <span class="px-3.5 py-1.5 rounded-full bg-forest-900/90 backdrop-blur-md text-gold-300 border border-gold-500/40 text-xs font-bold shadow-xl flex items-center gap-1.5 transform scale-95 group-hover/avatar:scale-100 transition-transform">
                                        <i class="fa-solid fa-magnifying-glass-plus text-xs"></i>
                                        <span>Click to view full photo</span>
                                    </span>
                                </div>
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-forest-900 via-forest-950 to-forest-900 text-gold-400 p-8 text-center">
                                    <div class="w-20 h-20 rounded-2xl bg-gold-400/10 border border-gold-400/30 flex items-center justify-center mb-3 shadow-inner">
                                        <span class="brand-crest text-gold-300 font-bold text-2xl">NOA</span>
                                    </div>
                                    <span class="text-xs uppercase font-bold text-gold-400/80 tracking-widest">In Memoriam</span>
                                </div>
                            @endif
                        </div>

                        <div class="p-6 space-y-4">
                            <div>
                                <span class="text-[10px] uppercase font-bold text-slate-400 block">Cadastral Cadre</span>
                                <span class="text-xs font-bold text-forest-900">{{ $member->cadre }} (Reg: {{ $member->registration_no }})</span>
                            </div>

                            <div>
                                <span class="text-[10px] uppercase font-bold text-slate-400 block">Branch Assignment</span>
                                <span class="text-xs font-semibold text-slate-800">{{ $member->branch_location }}</span>
                            </div>

                            @if($member->phone)
                                <div>
                                    <span class="text-[10px] uppercase font-bold text-slate-400 block">Telephone</span>
                                    <a href="tel:{{ $member->phone }}" class="text-xs font-bold text-forest-900 hover:text-gold-700 font-mono">
                                        {{ $member->phone }}
                                    </a>
                                </div>
                            @endif

                            @if($member->email)
                                <div>
                                    <span class="text-[10px] uppercase font-bold text-slate-400 block">Email Address</span>
                                    <a href="mailto:{{ $member->email }}" class="text-xs font-semibold text-forest-900 hover:text-gold-700">
                                        {{ $member->email }}
                                    </a>
                                </div>
                            @endif

                            <div class="pt-2">
                                <a href="{{ route('request-valuation') }}" class="block w-full py-3 rounded-xl bg-forest-900 hover:bg-forest-800 text-white font-bold text-xs uppercase tracking-wider text-center transition shadow">
                                    Commission Mandate
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Biography & Curriculum Vitae (8 cols) -->
                <div class="lg:col-span-8 space-y-8">
                    
                    <!-- Biography -->
                    <div class="bg-white rounded-3xl p-8 sm:p-10 border border-ivory-border shadow-sm space-y-4">
                        <h2 class="heading-serif text-2xl font-bold text-slate-900">
                            Executive Profile & Professional Standing
                        </h2>
                        <p class="text-slate-700 text-sm leading-relaxed whitespace-pre-line">
                            {{ $member->bio }}
                        </p>
                    </div>

                    <!-- Career History (if available) -->
                    @if(!empty($member->career_history) && is_array($member->career_history))
                        <div class="bg-white rounded-3xl p-8 sm:p-10 border border-ivory-border shadow-sm">
                            <h3 class="heading-serif text-xl font-bold text-slate-900 mb-6">
                                Career History & Institutional Roles
                            </h3>
                            <div class="space-y-4">
                                @foreach($member->career_history as $hist)
                                    <div class="flex items-start justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-100 text-xs">
                                        <div>
                                            <strong class="text-slate-900 block text-sm">{{ $hist['role'] ?? 'Role' }}</strong>
                                            <span class="text-slate-600">{{ $hist['company'] ?? 'Organization' }}</span>
                                        </div>
                                        <span class="px-2.5 py-1 rounded bg-forest-100 text-forest-900 font-mono font-bold text-[11px]">
                                            {{ $hist['period'] ?? '' }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Key Projects & Valuations -->
                    @if(!empty($member->key_projects) && is_array($member->key_projects))
                        <div class="bg-white rounded-3xl p-8 sm:p-10 border border-ivory-border shadow-sm">
                            <h3 class="heading-serif text-xl font-bold text-slate-900 mb-6">
                                Key Project & Valuation Track Record
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($member->key_projects as $proj)
                                    <div class="flex items-start p-3.5 rounded-xl bg-forest-50/70 border border-forest-100 text-xs text-slate-800">
                                        <i class="fa-solid fa-check-double text-gold-600 mt-0.5 mr-2.5 flex-shrink-0"></i>
                                        <span>{{ $proj }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>

@endsection
