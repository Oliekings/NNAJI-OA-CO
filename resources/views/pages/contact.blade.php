@extends('layouts.app')

@section('title', 'Branch Locations & Contact | NNAJI O.A & COMPANY')

@section('content')

    <!-- Banner -->
    <section class="bg-forest-950 text-white relative overflow-hidden">
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-gold-400/[0.03] rounded-full blur-3xl translate-y-1/2 translate-x-1/3"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
            <div class="max-w-2xl" style="animation: fadeInLeft 0.7s ease-out">
                <p class="text-gold-400 text-xs font-bold uppercase tracking-[0.2em] mb-3">National & International Presence</p>
                <h1 class="heading-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-[1.1] mb-4">
                    Branch Offices & Contact
                </h1>
                <div class="section-divider-left mb-4"></div>
                <p class="text-slate-300/90 text-sm leading-relaxed">
                    Connect with our principal partner and resident surveyors across Kaduna, Abuja, Abia State, or our North America representative desk.
                </p>
            </div>
        </div>
    </section>

    <!-- Content -->
    <div class="py-20 bg-ivory-base">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20">
            
            <!-- 4 Branches -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach([
                    ['icon' => 'fa-landmark', 'label' => 'Operational HQ', 'title' => 'Kaduna Head Office', 'address' => 'Plot No. 7 Yunus Ustaz Usman Road (formerly Zaki Road) Abakpa G.R.A., P.O. Box 1607, Kaduna.', 'phone' => '08035044633', 'person' => 'Chief O. A. Nnaji (FNIVS)', 'featured' => true],
                    ['icon' => 'fa-building', 'label' => 'Federal Capital Desk', 'title' => 'Abuja Regional Office', 'address' => 'No. 24 Asaris Plaza, Block A, I.T. Igbani Street, Jabi, P.O. Box 9246, Abuja FCT.', 'phone' => '08037002395, 08187666130', 'person' => 'Ikechukwu Nnaji (ANIVS)', 'featured' => false],
                    ['icon' => 'fa-map-location-dot', 'label' => 'Eastern Regional Desk', 'title' => 'Abia State Branch', 'address' => 'Umuopara by Abia Tower Expressway, P.O. Box 727, Umuahia, Abia State.', 'phone' => '08062854080', 'person' => 'Ikenna Onwumere (B.Tech)', 'featured' => false],
                    ['icon' => 'fa-globe', 'label' => 'North America Desk', 'title' => 'USA Link Representative', 'address' => '15650 Fenkell Str. Apt. 210, Detroit, MI 48227, United States of America.', 'phone' => '', 'person' => 'Mrs. Chidi Nnaji (MBA)', 'featured' => false],
                ] as $i => $branch)
                    <div class="card-lift bg-white rounded-2xl p-6 {{ $branch['featured'] ? 'border-2 border-gold-500/40 shadow-md' : 'border border-ivory-border/80 shadow-sm' }} flex flex-col justify-between reveal relative overflow-hidden" style="--i: {{ $i }}">
                        @if($branch['featured'])
                            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-bl from-gold-100/50 to-transparent rounded-bl-[30px]"></div>
                        @endif
                        <div class="relative z-10">
                            <div class="w-10 h-10 rounded-xl bg-forest-900 text-gold-400 flex items-center justify-center mb-4 shadow-sm">
                                <i class="fa-solid {{ $branch['icon'] }}"></i>
                            </div>
                            <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-gold-700 block mb-1">{{ $branch['label'] }}</span>
                            <h3 class="font-bold text-slate-900 text-base mb-2">{{ $branch['title'] }}</h3>
                            <p class="text-slate-500 text-xs leading-relaxed mb-4">
                                {{ $branch['address'] }}
                            </p>
                        </div>
                        <div class="pt-4 border-t border-slate-100/80 space-y-1.5 text-xs relative z-10">
                            @if($branch['phone'])
                                <div class="text-forest-900 font-bold font-mono flex items-center gap-1.5">
                                    <i class="fa-solid fa-phone text-gold-600 text-[10px]"></i> {{ $branch['phone'] }}
                                </div>
                            @endif
                            <div class="text-slate-500 flex items-center gap-1.5">
                                <i class="fa-solid fa-user-tie text-gold-600 text-[10px]"></i> {{ $branch['person'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Contact Form -->
            <div class="bg-white rounded-3xl p-8 sm:p-12 border border-ivory-border shadow-sm max-w-4xl mx-auto reveal-scale relative overflow-hidden">
                <div class="absolute top-0 right-0 w-40 h-40 bg-gold-100/30 rounded-full blur-3xl"></div>
                <div class="relative z-10">
                    <div class="text-center space-y-3 mb-10">
                        <p class="text-gold-700 text-xs font-bold uppercase tracking-[0.2em]">Direct Inquiries</p>
                        <h2 class="heading-serif text-2xl sm:text-3xl font-bold text-slate-900">
                            Send Us a Message
                        </h2>
                        <div class="section-divider"></div>
                        <p class="text-slate-500 text-sm max-w-md mx-auto">
                            For general enquiries, agency instructions, or partnership correspondence.
                        </p>
                    </div>

                    <form action="{{ route('inquiry.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="hidden" name="type" value="general_contact">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Your Full Name *</label>
                                <input type="text" name="name" required placeholder="Dr. / Chief / Mr..." class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Organization</label>
                                <input type="text" name="organization" placeholder="e.g. Keystone Bank" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none transition-all">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Email *</label>
                                <input type="email" name="email" required placeholder="name@company.com" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Phone *</label>
                                <input type="text" name="phone" required placeholder="0803 000 0000" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Subject</label>
                            <input type="text" name="subject" placeholder="e.g. Property Management Inquiry" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Message *</label>
                            <textarea name="message" rows="4" required placeholder="Type your message here..." class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none transition-all resize-none"></textarea>
                        </div>

                        <div class="text-center pt-2">
                            <button type="submit" class="px-8 py-3.5 rounded-xl bg-forest-900 hover:bg-forest-800 text-white font-bold text-[11px] uppercase tracking-wider transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98] inline-flex items-center gap-2">
                                <i class="fa-solid fa-paper-plane text-gold-400"></i> Submit Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
