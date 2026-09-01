<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') | NNAJI O.A & COMPANY CMS</title>

    <!-- Favicon & PWA Icons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=3">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=3">
    <meta name="theme-color" content="#061b13">

    <!-- Google Fonts & FontAwesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: {
                            950: '#061b13',
                            900: '#0a2a1e',
                            850: '#0d3425',
                            800: '#0f3d2e',
                            700: '#14533e',
                            600: '#1c6e54',
                            500: '#248a6a',
                        },
                        gold: {
                            500: '#c5a059',
                            400: '#d4af37',
                            300: '#e7cf84',
                            100: '#fbf6e8',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        cinzel: ['Cinzel', 'serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
    </style>
    @stack('styles')
</head>
<body class="flex h-screen overflow-hidden bg-slate-100 text-slate-800">

    <!-- Sidebar Navigation -->
    <aside class="w-64 bg-forest-950 text-slate-300 flex flex-col flex-shrink-0 border-r border-forest-800">
        <!-- Logo Strip -->
        <div class="h-20 flex items-center px-6 bg-forest-900 border-b border-forest-800">
            <div class="w-8 h-8 rounded bg-gold-500 text-forest-950 font-bold flex items-center justify-center font-cinzel mr-3 text-sm">
                NOA
            </div>
            <div>
                <h1 class="text-white font-cinzel font-bold text-sm tracking-wider">NNAJI O.A & CO</h1>
                <span class="text-gold-400 text-[10px] uppercase font-semibold tracking-widest">Estate CMS &bull; Automation</span>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto text-sm font-medium">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.index') ? 'bg-forest-800 text-gold-400 font-semibold' : 'text-slate-300 hover:bg-forest-900 hover:text-white' }}">
                <i class="fa-solid fa-chart-line w-6 text-gold-400"></i>
                Dashboard Overview
            </a>

            <div class="pt-4 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400 px-3">
                Property & Lifecycle
            </div>
            <a href="{{ route('admin.properties.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.properties.index') ? 'bg-forest-800 text-gold-400 font-semibold' : 'text-slate-300 hover:bg-forest-900 hover:text-white' }}">
                <span class="flex items-center">
                    <i class="fa-solid fa-city w-6 text-gold-400"></i>
                    All Properties & Deals
                </span>
            </a>
            <a href="{{ route('admin.properties.create') }}" class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.properties.create') ? 'bg-forest-800 text-gold-400 font-semibold' : 'text-slate-300 hover:bg-forest-900 hover:text-white' }}">
                <i class="fa-solid fa-plus-circle w-6 text-gold-400"></i>
                Add New Listing
            </a>

            <div class="pt-4 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400 px-3">
                Enterprise & Operations
            </div>
            <a href="{{ route('admin.inquiries.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.inquiries.*') ? 'bg-forest-800 text-gold-400 font-semibold' : 'text-slate-300 hover:bg-forest-900 hover:text-white' }}">
                <span class="flex items-center">
                    <i class="fa-solid fa-inbox w-6 text-gold-400"></i>
                    Client Inquiries
                </span>
                @php
                    $newInqs = \App\Models\Inquiry::where('status', 'new')->count();
                @endphp
                @if($newInqs > 0)
                    <span class="bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $newInqs }}</span>
                @endif
            </a>
            <a href="{{ route('admin.services.index') }}" class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.services.*') ? 'bg-forest-800 text-gold-400 font-semibold' : 'text-slate-300 hover:bg-forest-900 hover:text-white' }}">
                <i class="fa-solid fa-briefcase w-6 text-gold-400"></i>
                Practice Services
            </a>
            <a href="{{ route('admin.team.index') }}" class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.team.*') ? 'bg-forest-800 text-gold-400 font-semibold' : 'text-slate-300 hover:bg-forest-900 hover:text-white' }}">
                <i class="fa-solid fa-users-gear w-6 text-gold-400"></i>
                Partners & Surveyors
            </a>
            <a href="{{ route('admin.profile.edit') }}" class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.profile.*') ? 'bg-forest-800 text-gold-400 font-semibold' : 'text-slate-300 hover:bg-forest-900 hover:text-white' }}">
                <i class="fa-solid fa-key w-6 text-gold-400"></i>
                Account & Password
            </a>

            <div class="pt-4 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400 px-3">
                Live Public Site
            </div>
            <a href="{{ route('home') }}" target="_blank" class="flex items-center px-3 py-2 rounded-lg text-slate-400 hover:text-gold-300 hover:bg-forest-900 transition text-xs">
                <i class="fa-solid fa-arrow-up-right-from-square w-6"></i>
                View Public Website
            </a>
            <a href="{{ route('properties.portfolio') }}" target="_blank" class="flex items-center px-3 py-2 rounded-lg text-slate-400 hover:text-gold-300 hover:bg-forest-900 transition text-xs">
                <i class="fa-solid fa-award w-6"></i>
                View Closed Deals / Portfolio
            </a>
        </nav>

        <!-- Current User Profile & Logout -->
        <div class="p-4 bg-forest-900 border-t border-forest-800">
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.profile.edit') }}" class="flex items-center space-x-3 group/user hover:opacity-90 transition">
                    <div class="w-9 h-9 rounded-full bg-gold-400/20 text-gold-400 flex items-center justify-center font-bold group-hover/user:scale-105 transition-transform">
                        <i class="fa-solid fa-user-tie text-sm"></i>
                    </div>
                    <div class="overflow-hidden">
                        <div class="text-xs font-bold text-white truncate group-hover/user:text-gold-300 transition-colors">{{ auth()->user()->name ?? 'Administrator' }}</div>
                        <div class="text-[10px] text-slate-400 truncate flex items-center gap-1"><i class="fa-solid fa-gear text-[9px] text-gold-500"></i> Settings</div>
                    </div>
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" title="Logout" class="text-slate-400 hover:text-red-400 transition p-1.5">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Body -->
    <div class="flex-1 flex flex-col overflow-hidden">
        
        <!-- Top App Bar -->
        <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-8 flex-shrink-0">
            <div class="flex items-center space-x-3">
                <h2 class="text-xl font-bold text-forest-900">@yield('header_title', 'Dashboard')</h2>
                <span class="text-xs text-slate-400">|</span>
                <span class="text-xs text-slate-500">@yield('header_subtitle', 'NNAJI O.A & COMPANY Property Automation')</span>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.profile.edit') }}" class="px-3 py-2 rounded-lg border border-slate-200 hover:bg-slate-50 text-slate-700 font-medium text-xs flex items-center transition">
                    <i class="fa-solid fa-lock text-gold-600 mr-1.5"></i> Change Password
                </a>
                <a href="{{ route('admin.properties.create') }}" class="px-3.5 py-2 rounded-lg bg-forest-900 hover:bg-forest-800 text-white font-medium text-xs flex items-center transition shadow-sm">
                    <i class="fa-solid fa-plus mr-1.5 text-gold-400"></i> New Property
                </a>
                <a href="{{ route('home') }}" target="_blank" class="px-3 py-2 rounded-lg border border-slate-200 hover:bg-slate-50 text-slate-700 font-medium text-xs flex items-center transition">
                    <i class="fa-solid fa-globe mr-1.5 text-slate-500"></i> View Site
                </a>
            </div>
        </header>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-emerald-600 text-white px-6 py-3 text-sm flex items-center justify-between shadow-sm">
                <span><i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-white hover:text-emerald-200"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-600 text-white px-6 py-3 text-sm flex items-center justify-between shadow-sm">
                <span><i class="fa-solid fa-triangle-exclamation mr-2"></i> {{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-white hover:text-red-200"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif

        <!-- Scrollable Dashboard Content Area -->
        <main class="flex-1 overflow-y-auto p-8 bg-slate-50">
            @yield('content')
        </main>

    </div>

    @stack('scripts')
</body>
</html>
