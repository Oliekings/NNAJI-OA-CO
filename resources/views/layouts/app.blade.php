<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'NNAJI O.A & COMPANY | Estate Surveyors & Valuers')</title>
    <meta name="description" content="@yield('meta_description', 'NNAJI O.A & COMPANY - Premier Nigerian firm of Estate Surveyors & Valuers established in 1981. Over 40+ years in asset valuations, plant & machinery appraisal, and real estate advisory.')">

    <!-- Favicon & PWA Icons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=3">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=3">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="theme-color" content="#061b13">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!-- Open Graph / Facebook / LinkedIn / WhatsApp Social Share -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="NNAJI O.A & COMPANY">
    <meta property="og:title" content="@yield('title', 'NNAJI O.A & COMPANY | Estate Surveyors & Valuers')">
    <meta property="og:description" content="@yield('meta_description', 'NNAJI O.A & COMPANY - Premier Nigerian firm of Estate Surveyors & Valuers established in 1981. Over 40+ years in asset valuations, plant & machinery appraisal, and real estate advisory.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-share-banner.jpg'))">
    <meta property="og:image:secure_url" content="@yield('og_image', asset('images/og-share-banner.jpg'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:alt" content="NNAJI O.A & COMPANY Brand Banner">

    <!-- Twitter / X Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('title', 'NNAJI O.A & COMPANY | Estate Surveyors & Valuers')">
    <meta name="twitter:description" content="@yield('meta_description', 'NNAJI O.A & COMPANY - Premier Nigerian firm of Estate Surveyors & Valuers established in 1981. Over 40+ years in asset valuations, plant & machinery appraisal, and real estate advisory.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-share-banner.jpg'))">

    <!-- Google Fonts: Playfair Display + Plus Jakarta Sans + Cinzel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS (CDN for instant standalone rendering & Google Stitch tokens) -->
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
                            900: '#5c4308',
                            800: '#75540b',
                            700: '#8c6812',
                            600: '#a87f17',
                            500: '#c5a059',
                            400: '#d4af37',
                            300: '#e7cf84',
                            200: '#f3e6b5',
                            100: '#fbf6e8',
                            50: '#fefdf9',
                        },
                        ivory: {
                            base: '#fdfbf7',
                            surface: '#ffffff',
                            alt: '#f4f0e6',
                            muted: '#ece7da',
                            border: '#e2dbcb',
                        }
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'Georgia', 'serif'],
                        cinzel: ['Cinzel', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        /* ===== BASE STYLES (DESIGN.md tokens) ===== */
        body {
            background-color: #fdfbf7;
            color: #121816;
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }
        .heading-serif { font-family: 'Playfair Display', Georgia, serif; }
        .brand-crest { font-family: 'Cinzel', serif; letter-spacing: 0.15em; }

        /* ===== GOLD GRADIENT TEXT ===== */
        .gold-gradient-text {
            background: linear-gradient(135deg, #d4af37 0%, #f3e6b5 50%, #c5a059 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* ===== GLASSMORPHISM ===== */
        .glass-nav {
            background: rgba(10, 42, 30, 0.92);
            backdrop-filter: blur(20px) saturate(1.8);
            -webkit-backdrop-filter: blur(20px) saturate(1.8);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .glass-nav.scrolled {
            background: rgba(6, 27, 19, 0.98);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3), 0 0 0 1px rgba(212,175,55,0.1);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 219, 203, 0.8);
        }
        .gold-border-glow {
            border: 1px solid rgba(212, 175, 55, 0.4);
            box-shadow: 0 4px 20px -2px rgba(212, 175, 55, 0.15);
        }

        /* ===== KEYFRAME ANIMATIONS ===== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(32px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-28px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(28px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.92); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        @keyframes pulse-gold {
            0%, 100% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.4); }
            50% { box-shadow: 0 0 0 8px rgba(212, 175, 55, 0); }
        }
        @keyframes marquee {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }
        @keyframes counter-up {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes draw-line {
            from { width: 0; }
            to { width: 100%; }
        }

        /* ===== SCROLL-REVEAL CLASSES ===== */
        .reveal {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-left {
            opacity: 0;
            transform: translateX(-32px);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal-left.revealed {
            opacity: 1;
            transform: translateX(0);
        }
        .reveal-right {
            opacity: 0;
            transform: translateX(32px);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal-right.revealed {
            opacity: 1;
            transform: translateX(0);
        }
        .reveal-scale {
            opacity: 0;
            transform: scale(0.92);
            transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal-scale.revealed {
            opacity: 1;
            transform: scale(1);
        }

        /* ===== STAGGER CHILDREN ===== */
        .stagger-children > * { transition-delay: calc(var(--i, 0) * 100ms); }

        /* ===== MARQUEE TRUST STRIP ===== */
        .marquee-container { overflow: hidden; white-space: nowrap; }
        .marquee-content {
            display: inline-flex;
            animation: marquee 40s linear infinite;
        }
        .marquee-container:hover .marquee-content { animation-play-state: paused; }

        /* ===== GOLD SHIMMER LINE ===== */
        .shimmer-line {
            height: 2px;
            background: linear-gradient(90deg, transparent, #d4af37, #e7cf84, #d4af37, transparent);
            background-size: 200% auto;
            animation: shimmer 3s ease-in-out infinite;
        }

        /* ===== FLOATING CTA PULSE ===== */
        .cta-pulse { animation: pulse-gold 2s ease-in-out infinite; }

        /* ===== CARD HOVER MICRO-EFFECTS ===== */
        .card-lift {
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1),
                        box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .card-lift:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -12px rgba(10, 42, 30, 0.15),
                        0 8px 16px -6px rgba(10, 42, 30, 0.08);
        }

        /* ===== NAV LINK UNDERLINE EFFECT ===== */
        .nav-link {
            position: relative;
            padding-bottom: 2px;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #d4af37, #c5a059);
            transition: width 0.3s ease, left 0.3s ease;
            border-radius: 1px;
        }
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
            left: 0;
        }

        /* ===== SECTION DECORATIVE DIVIDER ===== */
        .section-divider {
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #d4af37, #c5a059);
            border-radius: 2px;
            margin: 0 auto;
        }
        .section-divider-left {
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #d4af37, #c5a059);
            border-radius: 2px;
        }

        /* ===== TOAST ANIMATION ===== */
        .toast-enter {
            animation: fadeInUp 0.4s ease-out;
        }

        /* ===== MOBILE DRAWER ===== */
        .mobile-drawer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .mobile-drawer.open { max-height: 500px; }
    </style>
    @stack('styles')
</head>
<body class="flex flex-col min-h-screen">

    <!-- Marquee Trust Strip -->
    <div class="bg-forest-950 text-gold-200 py-1.5 border-b border-forest-900/80 hidden md:block">
        <div class="marquee-container">
            <div class="marquee-content gap-12 text-[11px] font-medium tracking-wide">
                <span class="inline-flex items-center gap-1.5 px-4"><i class="fa-solid fa-certificate text-gold-400"></i> Registered Estate Surveyors & Valuers (Est. 1981)</span>
                <span class="inline-flex items-center gap-1.5 px-4"><i class="fa-solid fa-shield-halved text-gold-400"></i> NIESV Corporate Member</span>
                <span class="inline-flex items-center gap-1.5 px-4"><i class="fa-solid fa-stamp text-gold-400"></i> ESVRBON Reg No. F231</span>
                <span class="inline-flex items-center gap-1.5 px-4"><i class="fa-solid fa-earth-americas text-gold-400"></i> CASLE International Affiliate</span>
                <span class="inline-flex items-center gap-1.5 px-4"><i class="fa-solid fa-phone text-gold-400"></i> 08037002395, 08187666130</span>
                <span class="inline-flex items-center gap-1.5 px-4"><i class="fa-solid fa-envelope text-gold-400"></i> nnajioacompany@gmail.com</span>
                <span class="inline-flex items-center gap-1.5 px-4"><i class="fa-solid fa-map-pin text-gold-400"></i> Abuja • Kaduna HQ • Abia • Detroit USA</span>
                <!-- Duplicate for seamless loop -->
                <span class="inline-flex items-center gap-1.5 px-4"><i class="fa-solid fa-certificate text-gold-400"></i> Registered Estate Surveyors & Valuers (Est. 1981)</span>
                <span class="inline-flex items-center gap-1.5 px-4"><i class="fa-solid fa-shield-halved text-gold-400"></i> NIESV Corporate Member</span>
                <span class="inline-flex items-center gap-1.5 px-4"><i class="fa-solid fa-stamp text-gold-400"></i> ESVRBON Reg No. F231</span>
                <span class="inline-flex items-center gap-1.5 px-4"><i class="fa-solid fa-earth-americas text-gold-400"></i> CASLE International Affiliate</span>
                <span class="inline-flex items-center gap-1.5 px-4"><i class="fa-solid fa-phone text-gold-400"></i> 08037002395, 08187666130</span>
                <span class="inline-flex items-center gap-1.5 px-4"><i class="fa-solid fa-envelope text-gold-400"></i> nnajioacompany@gmail.com</span>
                <span class="inline-flex items-center gap-1.5 px-4"><i class="fa-solid fa-map-pin text-gold-400"></i> Abuja • Kaduna HQ • Abia • Detroit USA</span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header id="main-nav" class="glass-nav sticky top-0 z-50 border-b border-gold-500/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20 transition-all duration-300" id="nav-inner">
                
                <!-- Brand Logo & Badge -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-gold-400 via-gold-500 to-forest-800 p-[2px] shadow-lg group-hover:shadow-gold transition-shadow duration-300">
                        <div class="w-full h-full bg-forest-900 rounded-[10px] flex items-center justify-center flex-col text-center">
                            <span class="brand-crest text-gold-400 text-xs font-black tracking-wider leading-none">NOA</span>
                            <span class="text-[7px] text-gold-300/70 uppercase tracking-tight mt-0.5">Est. 1981</span>
                        </div>
                    </div>
                    <div>
                        <div class="brand-crest text-white text-sm md:text-base font-bold tracking-[0.2em] leading-none group-hover:text-gold-300 transition-colors duration-300">
                            NNAJI O.A & COMPANY
                        </div>
                        <div class="text-gold-400/80 text-[10px] tracking-[0.15em] uppercase font-medium mt-1">
                            Estate Surveyors & Valuers
                        </div>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center space-x-1 text-[13px] font-medium text-slate-300">
                    <a href="{{ route('home') }}" class="nav-link px-3 py-2 hover:text-gold-300 transition {{ request()->routeIs('home') ? 'active text-gold-400 font-semibold' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('about') }}" class="nav-link px-3 py-2 hover:text-gold-300 transition {{ request()->routeIs('about') ? 'active text-gold-400 font-semibold' : '' }}">
                        About Us
                    </a>
                    <a href="{{ route('services.index') }}" class="nav-link px-3 py-2 hover:text-gold-300 transition {{ request()->routeIs('services.*') ? 'active text-gold-400 font-semibold' : '' }}">
                        Services
                    </a>
                    <a href="{{ route('properties.index') }}" class="nav-link px-3 py-2 hover:text-gold-300 transition {{ request()->routeIs('properties.index') ? 'active text-gold-400 font-semibold' : '' }}">
                        Properties
                    </a>
                    <a href="{{ route('properties.portfolio') }}" class="nav-link px-3 py-2 hover:text-gold-300 transition {{ request()->routeIs('properties.portfolio') || request()->routeIs('closed-deals') ? 'active text-gold-400 font-semibold' : '' }}">
                        Portfolio
                    </a>
                    <a href="{{ route('team.index') }}" class="nav-link px-3 py-2 hover:text-gold-300 transition {{ request()->routeIs('team.*') ? 'active text-gold-400 font-semibold' : '' }}">
                        Leadership
                    </a>
                    <a href="{{ route('contact') }}" class="nav-link px-3 py-2 hover:text-gold-300 transition {{ request()->routeIs('contact') ? 'active text-gold-400 font-semibold' : '' }}">
                        Contact
                    </a>
                </nav>

                <!-- Action Buttons -->
                <div class="hidden sm:flex items-center space-x-3">
                    <a href="{{ route('request-valuation') }}" class="cta-pulse inline-flex items-center px-5 py-2.5 rounded-xl bg-gradient-to-r from-gold-500 to-gold-400 text-forest-950 font-bold text-[11px] tracking-wider uppercase hover:from-gold-400 hover:to-gold-300 transition-all duration-300 shadow-md hover:shadow-lg">
                        <i class="fa-solid fa-file-signature mr-2"></i> Request Valuation
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center lg:hidden">
                    <button id="mobile-menu-btn" type="button" class="text-gold-300 hover:text-white p-2 focus:outline-none transition-transform active:scale-90">
                        <i class="fa-solid fa-bars text-xl" id="menu-icon"></i>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Drawer -->
        <div id="mobile-menu" class="mobile-drawer lg:hidden bg-forest-950/98 border-t border-forest-800/50 px-4 pb-6">
            <div class="pt-4 space-y-1">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-white font-medium hover:bg-forest-800/50 transition">Home</a>
                <a href="{{ route('about') }}" class="block px-4 py-3 rounded-xl text-white font-medium hover:bg-forest-800/50 transition">About Us</a>
                <a href="{{ route('services.index') }}" class="block px-4 py-3 rounded-xl text-white font-medium hover:bg-forest-800/50 transition">Services</a>
                <a href="{{ route('properties.index') }}" class="block px-4 py-3 rounded-xl text-white font-medium hover:bg-forest-800/50 transition">Properties</a>
                <a href="{{ route('properties.portfolio') }}" class="block px-4 py-3 rounded-xl text-gold-300 font-medium hover:bg-forest-800/50 transition">Portfolio & Closed Deals</a>
                <a href="{{ route('team.index') }}" class="block px-4 py-3 rounded-xl text-white font-medium hover:bg-forest-800/50 transition">Leadership</a>
                <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-xl text-white font-medium hover:bg-forest-800/50 transition">Contact</a>
            </div>
            <div class="pt-4 px-4">
                <a href="{{ route('request-valuation') }}" class="block text-center w-full px-4 py-3.5 rounded-xl bg-gradient-to-r from-gold-500 to-gold-400 text-forest-950 font-bold text-xs uppercase tracking-wider shadow-lg">
                    Request Asset Valuation
                </a>
            </div>
        </div>
    </header>

    <!-- Global Toast Alerts -->
    @if(session('success'))
        <div class="toast-enter bg-emerald-600 text-white px-6 py-3.5 shadow-lg relative z-40 flex items-center justify-center gap-2 font-medium text-sm">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="toast-enter bg-red-600 text-white px-6 py-3.5 shadow-lg relative z-40 flex items-center justify-center gap-2 font-medium text-sm">
            <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Pre-Footer CTA Band -->
    <section class="bg-gradient-to-r from-forest-950 via-forest-900 to-forest-950 py-14 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.04]" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23d4af37\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
            <p class="text-gold-400 text-xs uppercase tracking-[0.25em] font-bold mb-3">Ready to Get Started?</p>
            <h2 class="heading-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-4">
                Commission a Professional Valuation Today
            </h2>
            <p class="text-slate-400 text-sm mb-8 max-w-xl mx-auto">
                Whether you need a statutory asset appraisal, property management brief, or investment feasibility study — our registered surveyors are ready.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('request-valuation') }}" class="px-8 py-4 rounded-xl bg-gradient-to-r from-gold-500 to-gold-400 text-forest-950 font-bold text-xs uppercase tracking-wider hover:from-gold-400 hover:to-gold-300 transition-all duration-300 shadow-lg hover:shadow-gold inline-flex items-center gap-2">
                    <i class="fa-solid fa-file-signature"></i> Request Valuation
                </a>
                <a href="tel:08037002395" class="px-8 py-4 rounded-xl border border-gold-500/40 text-gold-300 font-bold text-xs uppercase tracking-wider hover:bg-forest-800 transition inline-flex items-center gap-2">
                    <i class="fa-solid fa-phone"></i> Call 08037002395
                </a>
            </div>
        </div>
    </section>

    <!-- Corporate Footer -->
    <footer class="bg-forest-950 text-slate-400 pt-16 pb-10">
        <!-- Gold Shimmer Line -->
        <div class="shimmer-line mb-12"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-forest-800/50">
                
                <!-- Firm Overview -->
                <div class="lg:col-span-2 space-y-5">
                    <div class="flex items-center space-x-3">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-gold-400 to-gold-600 p-[2px]">
                            <div class="w-full h-full bg-forest-950 rounded-[9px] flex items-center justify-center">
                                <span class="brand-crest text-gold-400 text-[10px] font-black">NOA</span>
                            </div>
                        </div>
                        <div>
                            <span class="brand-crest text-white text-sm font-bold tracking-wider block">NNAJI O.A & COMPANY</span>
                            <span class="text-gold-500/80 text-[10px] tracking-wider uppercase font-semibold">Estate Surveyors & Valuers</span>
                        </div>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed pr-6">
                        Recognized in 1981 by NIESV & ESVRBON. Over 40 years of professional integrity in Property Valuation, Plant & Machinery Appraisals, Facility Management, and Corporate Real Estate Consultancy.
                    </p>
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-widest text-gold-500/70 mb-2.5">Statutory Registrations</div>
                        <div class="flex flex-wrap gap-2 text-[10px] text-slate-400 font-mono">
                            <span class="bg-forest-900/80 px-2.5 py-1 rounded-lg border border-forest-800/60">RC 424962</span>
                            <span class="bg-forest-900/80 px-2.5 py-1 rounded-lg border border-forest-800/60">ESVRBON F231</span>
                            <span class="bg-forest-900/80 px-2.5 py-1 rounded-lg border border-forest-800/60">PENCOM LWFIRMOO1828</span>
                            <span class="bg-forest-900/80 px-2.5 py-1 rounded-lg border border-forest-800/60">TIN 1022906307</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-semibold text-xs tracking-wider uppercase mb-5 flex items-center gap-2">
                        <span class="w-5 h-[2px] bg-gold-500"></span> Practice Areas
                    </h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('services.show', 'property-valuation') }}" class="hover:text-gold-400 transition-colors duration-200 hover:translate-x-1 inline-block">Property Valuation</a></li>
                        <li><a href="{{ route('services.show', 'property-valuation') }}" class="hover:text-gold-400 transition-colors duration-200 hover:translate-x-1 inline-block">Plant & Machinery</a></li>
                        <li><a href="{{ route('services.show', 'property-management') }}" class="hover:text-gold-400 transition-colors duration-200 hover:translate-x-1 inline-block">Facility Management</a></li>
                        <li><a href="{{ route('services.show', 'estate-agency') }}" class="hover:text-gold-400 transition-colors duration-200 hover:translate-x-1 inline-block">Estate Agency</a></li>
                        <li><a href="{{ route('services.show', 'investment-appraisal') }}" class="hover:text-gold-400 transition-colors duration-200 hover:translate-x-1 inline-block">Investment Appraisal</a></li>
                    </ul>
                </div>

                <!-- Branch Network -->
                <div class="lg:col-span-2 space-y-5">
                    <h4 class="text-white font-semibold text-xs tracking-wider uppercase mb-5 flex items-center gap-2">
                        <span class="w-5 h-[2px] bg-gold-500"></span> Office Network
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="group p-3.5 rounded-xl bg-forest-900/40 border border-forest-800/40 hover:border-gold-500/30 transition-colors duration-300">
                            <span class="text-gold-400 font-bold text-[11px] block mb-1">Abuja Office</span>
                            <p class="text-slate-500 text-[11px] leading-relaxed">Block 07, Drive 1, Prince and Princess Estate, Abuja, FCT.</p>
                            <p class="text-gold-500/60 text-[10px] font-mono mt-1">08037002395, 08187666130</p>
                        </div>
                        <div class="group p-3.5 rounded-xl bg-forest-900/40 border border-forest-800/40 hover:border-gold-500/30 transition-colors duration-300">
                            <span class="text-gold-400 font-bold text-[11px] block mb-1">Kaduna Office</span>
                            <p class="text-slate-500 text-[11px] leading-relaxed">Plot 7 Yunus Ustaz Usman Rd, Abakpa G.R.A.</p>
                            <p class="text-gold-500/60 text-[10px] font-mono mt-1">08037002395, 08187666130</p>
                        </div>
                        <div class="group p-3.5 rounded-xl bg-forest-900/40 border border-forest-800/40 hover:border-gold-500/30 transition-colors duration-300">
                            <span class="text-gold-400 font-bold text-[11px] block mb-1">Abia State</span>
                            <p class="text-slate-500 text-[11px] leading-relaxed">Umuopara by Abia Tower Expressway</p>
                            <p class="text-gold-500/60 text-[10px] font-mono mt-1">08037002395, 08187666130</p>
                        </div>
                        <div class="group p-3.5 rounded-xl bg-forest-900/40 border border-forest-800/40 hover:border-gold-500/30 transition-colors duration-300">
                            <span class="text-gold-400 font-bold text-[11px] block mb-1">USA Link</span>
                            <p class="text-slate-500 text-[11px] leading-relaxed">15650 Fenkell Str, Detroit, MI</p>
                            <p class="text-gold-500/60 text-[10px] font-mono mt-1">North America Desk</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Bar -->
            <div class="pt-8 flex flex-col items-center text-xs text-slate-500 space-y-4">
                <div class="w-full flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <p>&copy; {{ date('Y') }} <strong class="text-slate-400">NNAJI O.A & COMPANY</strong>. All rights reserved. NIESV • ESVRBON • CASLE.</p>
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('about') }}" class="hover:text-gold-400 transition">About</a>
                        <a href="{{ route('properties.portfolio') }}" class="hover:text-gold-400 transition">Portfolio</a>
                        <a href="{{ route('contact') }}" class="hover:text-gold-400 transition">Contact</a>
                    </div>
                </div>
                <div class="text-slate-500/60 text-[11px] tracking-wide">
                    Designed with <span class="text-red-400">♥</span> for perfection. <a href="https://surprisemfstech.com" target="_blank" rel="noopener noreferrer" class="text-gold-400/70 hover:text-gold-400 transition-colors duration-200 font-semibold">Surprise-MFs Tech</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Interactive Zoomable Image Lightbox Modal -->
    <div id="image-lightbox" class="fixed inset-0 z-[100] hidden bg-forest-950/95 backdrop-blur-2xl flex flex-col select-none opacity-0 transition-opacity duration-300">
        <!-- Top Toolbar -->
        <div class="h-16 px-4 sm:px-6 flex items-center justify-between border-b border-forest-800/80 bg-forest-950/80 z-20">
            <div class="flex items-center space-x-3 truncate">
                <div class="w-8 h-8 rounded-lg bg-gold-500/20 text-gold-400 border border-gold-500/30 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-camera"></i>
                </div>
                <div class="truncate">
                    <h4 id="lightbox-title" class="text-xs sm:text-sm font-bold text-white truncate max-w-xs sm:max-w-md">Property Image</h4>
                    <span id="lightbox-counter" class="text-[10px] text-gold-300/80 font-mono block">1 of 1</span>
                </div>
            </div>

            <!-- Controls Toolbar -->
            <div class="flex items-center space-x-1 sm:space-x-2">
                <!-- Zoom Out -->
                <button id="lightbox-zoom-out" type="button" class="w-9 h-9 rounded-xl bg-forest-900/80 hover:bg-forest-800 text-slate-200 hover:text-gold-300 border border-forest-700/50 flex items-center justify-center text-xs transition" title="Zoom Out (-)">
                    <i class="fa-solid fa-magnifying-glass-minus"></i>
                </button>

                <!-- Zoom Level Indicator -->
                <span id="lightbox-zoom-level" class="px-2.5 py-1 text-xs font-mono font-bold text-gold-300 bg-forest-900 border border-forest-700/50 rounded-lg min-w-[54px] text-center">
                    100%
                </span>

                <!-- Zoom In -->
                <button id="lightbox-zoom-in" type="button" class="w-9 h-9 rounded-xl bg-forest-900/80 hover:bg-forest-800 text-slate-200 hover:text-gold-300 border border-forest-700/50 flex items-center justify-center text-xs transition" title="Zoom In (+)">
                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                </button>

                <!-- Reset Zoom -->
                <button id="lightbox-zoom-reset" type="button" class="w-9 h-9 rounded-xl bg-forest-900/80 hover:bg-forest-800 text-slate-200 hover:text-gold-300 border border-forest-700/50 flex items-center justify-center text-xs transition hidden sm:flex" title="Reset Zoom (0)">
                    <i class="fa-solid fa-rotate-left"></i>
                </button>

                <!-- Fullscreen -->
                <button id="lightbox-fullscreen" type="button" class="w-9 h-9 rounded-xl bg-forest-900/80 hover:bg-forest-800 text-slate-200 hover:text-gold-300 border border-forest-700/50 flex items-center justify-center text-xs transition hidden sm:flex" title="Toggle Fullscreen">
                    <i class="fa-solid fa-expand"></i>
                </button>

                <!-- Close -->
                <button id="lightbox-close" type="button" class="w-9 h-9 rounded-xl bg-red-900/40 hover:bg-red-800 text-red-200 border border-red-700/50 flex items-center justify-center text-sm transition ml-2" title="Close (Esc)">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>

        <!-- Main Viewport Area -->
        <div id="lightbox-viewport" class="flex-1 relative overflow-hidden flex items-center justify-center cursor-grab active:cursor-grabbing p-4">
            <!-- Nav Previous -->
            <button id="lightbox-prev" type="button" class="absolute left-4 z-20 w-12 h-12 rounded-full bg-forest-900/80 hover:bg-forest-800 text-white border border-gold-500/40 shadow-xl flex items-center justify-center text-sm transition hover:scale-110">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <!-- Image Stage -->
            <div id="lightbox-stage" class="relative max-w-full max-h-full flex items-center justify-center transition-transform duration-100 ease-out">
                <img id="lightbox-img" src="" alt="" class="max-h-[80vh] max-w-[90vw] object-contain rounded-lg shadow-2xl transition-transform" draggable="false">
            </div>

            <!-- Nav Next -->
            <button id="lightbox-next" type="button" class="absolute right-4 z-20 w-12 h-12 rounded-full bg-forest-900/80 hover:bg-forest-800 text-white border border-gold-500/40 shadow-xl flex items-center justify-center text-sm transition hover:scale-110">
                <i class="fa-solid fa-chevron-right"></i>
            </button>

            <!-- Bottom Zoom Hint -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-10 px-4 py-1.5 rounded-full bg-black/60 backdrop-blur-md border border-white/10 text-[11px] text-slate-300 font-medium pointer-events-none">
                <i class="fa-solid fa-mouse text-gold-400 mr-1.5"></i> Scroll wheel or buttons to Zoom &bull; Click & Drag to Pan &bull; Double click to toggle 2x
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Mobile Drawer Toggle
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        if (btn && menu) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('open');
                if (menu.classList.contains('open')) {
                    menuIcon.classList.replace('fa-bars', 'fa-xmark');
                } else {
                    menuIcon.classList.replace('fa-xmark', 'fa-bars');
                }
            });
        }

        // Navbar Shrink on Scroll
        const nav = document.getElementById('main-nav');
        const navInner = document.getElementById('nav-inner');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 60) {
                nav.classList.add('scrolled');
                navInner.style.height = '64px';
            } else {
                nav.classList.remove('scrolled');
                navInner.style.height = '80px';
            }
        }, { passive: true });

        // Scroll Reveal Observer
        const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
        if (revealElements.length > 0) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        const parent = entry.target.parentElement;
                        if (parent) {
                            const siblings = parent.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
                            const idx = Array.from(siblings).indexOf(entry.target);
                            entry.target.style.transitionDelay = `${idx * 80}ms`;
                        }
                        entry.target.classList.add('revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
            revealElements.forEach(el => observer.observe(el));
        }

        // Animated Counters
        function animateCounters() {
            document.querySelectorAll('[data-count]').forEach(el => {
                const target = parseInt(el.getAttribute('data-count'));
                const prefix = el.getAttribute('data-prefix') || '';
                const suffix = el.getAttribute('data-suffix') || '';
                let current = 0;
                const increment = Math.max(1, Math.floor(target / 60));
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    el.textContent = prefix + current.toLocaleString() + suffix;
                }, 25);
            });
        }

        const metricsSection = document.querySelector('[data-metrics]');
        if (metricsSection) {
            const metricsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounters();
                        metricsObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.3 });
            metricsObserver.observe(metricsSection);
        }

        // ===== INTERACTIVE IMAGE LIGHTBOX WITH ZOOM & PAN =====
        const lightbox = {
            modal: document.getElementById('image-lightbox'),
            img: document.getElementById('lightbox-img'),
            stage: document.getElementById('lightbox-stage'),
            viewport: document.getElementById('lightbox-viewport'),
            title: document.getElementById('lightbox-title'),
            counter: document.getElementById('lightbox-counter'),
            zoomLevelText: document.getElementById('lightbox-zoom-level'),
            btnZoomIn: document.getElementById('lightbox-zoom-in'),
            btnZoomOut: document.getElementById('lightbox-zoom-out'),
            btnZoomReset: document.getElementById('lightbox-zoom-reset'),
            btnFullscreen: document.getElementById('lightbox-fullscreen'),
            btnClose: document.getElementById('lightbox-close'),
            btnPrev: document.getElementById('lightbox-prev'),
            btnNext: document.getElementById('lightbox-next'),
            
            items: [],
            currentIndex: 0,
            zoom: 1.0,
            minZoom: 0.5,
            maxZoom: 4.0,
            zoomStep: 0.25,
            
            panX: 0,
            panY: 0,
            isDragging: false,
            startX: 0,
            startY: 0,

            init() {
                if (!this.modal) return;

                // Event Listeners for controls
                this.btnZoomIn?.addEventListener('click', () => this.zoomBy(this.zoomStep));
                this.btnZoomOut?.addEventListener('click', () => this.zoomBy(-this.zoomStep));
                this.btnZoomReset?.addEventListener('click', () => this.resetZoom());
                this.btnClose?.addEventListener('click', () => this.close());
                this.btnPrev?.addEventListener('click', () => this.prev());
                this.btnNext?.addEventListener('click', () => this.next());

                this.btnFullscreen?.addEventListener('click', () => {
                    if (!document.fullscreenElement) {
                        this.modal.requestFullscreen().catch(() => {});
                    } else {
                        document.exitFullscreen().catch(() => {});
                    }
                });

                // Mouse wheel zoom
                this.viewport?.addEventListener('wheel', (e) => {
                    e.preventDefault();
                    const delta = e.deltaY < 0 ? this.zoomStep : -this.zoomStep;
                    this.zoomBy(delta);
                }, { passive: false });

                // Double click toggle 1x / 2x
                this.img?.addEventListener('dblclick', (e) => {
                    e.preventDefault();
                    if (this.zoom > 1.0) {
                        this.resetZoom();
                    } else {
                        this.setZoom(2.0);
                    }
                });

                // Drag / Pan Handling
                this.viewport?.addEventListener('mousedown', (e) => {
                    if (e.target.closest('button')) return;
                    this.isDragging = true;
                    this.startX = e.clientX - this.panX;
                    this.startY = e.clientY - this.panY;
                });

                window.addEventListener('mousemove', (e) => {
                    if (!this.isDragging) return;
                    this.panX = e.clientX - this.startX;
                    this.panY = e.clientY - this.startY;
                    this.applyTransform();
                });

                window.addEventListener('mouseup', () => {
                    this.isDragging = false;
                });

                // Touch swipe / pan for mobile
                let touchStartX = 0;
                let touchStartY = 0;
                this.viewport?.addEventListener('touchstart', (e) => {
                    if (e.touches.length === 1) {
                        this.isDragging = true;
                        touchStartX = e.touches[0].clientX - this.panX;
                        touchStartY = e.touches[0].clientY - this.panY;
                    }
                }, { passive: true });

                this.viewport?.addEventListener('touchmove', (e) => {
                    if (!this.isDragging || e.touches.length !== 1) return;
                    this.panX = e.touches[0].clientX - touchStartX;
                    this.panY = e.touches[0].clientY - touchStartY;
                    this.applyTransform();
                }, { passive: true });

                this.viewport?.addEventListener('touchend', () => {
                    this.isDragging = false;
                });

                // Keyboard controls
                window.addEventListener('keydown', (e) => {
                    if (this.modal.classList.contains('hidden')) return;

                    if (e.key === 'Escape') this.close();
                    if (e.key === 'ArrowLeft') this.prev();
                    if (e.key === 'ArrowRight') this.next();
                    if (e.key === '+' || e.key === '=') this.zoomBy(this.zoomStep);
                    if (e.key === '-' || e.key === '_') this.zoomBy(-this.zoomStep);
                    if (e.key === '0') this.resetZoom();
                });

                // Delegate clicks on any elements with data-lightbox-src or data-gallery
                document.addEventListener('click', (e) => {
                    const trigger = e.target.closest('[data-lightbox-src], [data-gallery-src]');
                    if (trigger) {
                        e.preventDefault();
                        e.stopPropagation();

                        const galleryName = trigger.getAttribute('data-gallery');
                        let items = [];

                        if (galleryName) {
                            const groupElements = document.querySelectorAll(`[data-gallery="${galleryName}"]`);
                            items = Array.from(groupElements).map(el => ({
                                src: el.getAttribute('data-lightbox-src') || el.getAttribute('data-gallery-src') || el.getAttribute('src') || el.getAttribute('href'),
                                title: el.getAttribute('data-title') || el.getAttribute('alt') || 'Property View'
                            }));
                            const currentSrc = trigger.getAttribute('data-lightbox-src') || trigger.getAttribute('data-gallery-src') || trigger.getAttribute('src') || trigger.getAttribute('href');
                            const index = items.findIndex(item => item.src === currentSrc);
                            this.open(items, Math.max(0, index));
                        } else {
                            const src = trigger.getAttribute('data-lightbox-src') || trigger.getAttribute('data-gallery-src') || trigger.getAttribute('src') || trigger.getAttribute('href');
                            const title = trigger.getAttribute('data-title') || trigger.getAttribute('alt') || 'Property Image';
                            this.open([{ src, title }], 0);
                        }
                    }
                });
            },

            open(items, startIndex = 0) {
                if (!items || items.length === 0) return;
                this.items = items;
                this.currentIndex = startIndex;
                this.modal.classList.remove('hidden');
                
                // Trigger fade-in
                setTimeout(() => {
                    this.modal.classList.remove('opacity-0');
                }, 10);

                document.body.style.overflow = 'hidden';
                this.render();
            },

            close() {
                this.modal.classList.add('opacity-0');
                setTimeout(() => {
                    this.modal.classList.add('hidden');
                    document.body.style.overflow = '';
                    this.resetZoom();
                }, 300);
            },

            render() {
                const item = this.items[this.currentIndex];
                if (!item) return;

                this.img.src = item.src;
                this.title.textContent = item.title;
                this.counter.textContent = `${this.currentIndex + 1} of ${this.items.length}`;

                // Toggle prev/next buttons if only 1 item
                if (this.items.length <= 1) {
                    this.btnPrev.classList.add('hidden');
                    this.btnNext.classList.add('hidden');
                } else {
                    this.btnPrev.classList.remove('hidden');
                    this.btnNext.classList.remove('hidden');
                }

                this.resetZoom();
            },

            prev() {
                if (this.items.length <= 1) return;
                this.currentIndex = (this.currentIndex - 1 + this.items.length) % this.items.length;
                this.render();
            },

            next() {
                if (this.items.length <= 1) return;
                this.currentIndex = (this.currentIndex + 1) % this.items.length;
                this.render();
            },

            zoomBy(amount) {
                this.setZoom(this.zoom + amount);
            },

            setZoom(newZoom) {
                this.zoom = Math.min(Math.max(newZoom, this.minZoom), this.maxZoom);
                this.zoomLevelText.textContent = `${Math.round(this.zoom * 100)}%`;
                if (this.zoom === 1.0) {
                    this.panX = 0;
                    this.panY = 0;
                }
                this.applyTransform();
            },

            resetZoom() {
                this.zoom = 1.0;
                this.panX = 0;
                this.panY = 0;
                this.zoomLevelText.textContent = '100%';
                this.applyTransform();
            },

            applyTransform() {
                this.stage.style.transform = `translate(${this.panX}px, ${this.panY}px) scale(${this.zoom})`;
            }
        };

        // Initialize Lightbox
        lightbox.init();
    </script>
    @stack('scripts')
</body>
</html>
