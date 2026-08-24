@extends('layouts.app')

@section('title', 'Commission Statutory Asset Valuation | NNAJI O.A & COMPANY')

@section('content')

    <!-- Banner -->
    <section class="bg-forest-950 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-80 h-80 bg-gold-400/[0.03] rounded-full blur-3xl -translate-y-1/3 translate-x-1/3"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
            <div class="max-w-2xl" style="animation: fadeInLeft 0.7s ease-out">
                <p class="text-gold-400 text-xs font-bold uppercase tracking-[0.2em] mb-3">Certified Valuation Portal</p>
                <h1 class="heading-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-[1.1] mb-4">
                    Request Statutory Asset Valuation
                </h1>
                <div class="section-divider-left mb-4"></div>
                <p class="text-slate-300/90 text-sm leading-relaxed">
                    Commission an official valuation report prepared in full accordance with NIESV standards and ESVRBON regulations for banking, balance sheet, insurance, or legal compensation purposes.
                </p>
            </div>
        </div>
    </section>

    <!-- Form -->
    <div class="py-16 bg-ivory-base">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl p-8 sm:p-12 border border-ivory-border shadow-sm reveal-scale relative overflow-hidden">
                <div class="absolute top-0 right-0 w-48 h-48 bg-gold-100/30 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 space-y-8">
                    @if($selectedProperty)
                        <div class="p-4 rounded-2xl bg-forest-50/50 border border-forest-100/60 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-forest-800">Regarding Property:</span>
                                <h4 class="font-bold text-forest-950 text-sm">{{ $selectedProperty->title }} (Ref: {{ $selectedProperty->reference_no }})</h4>
                            </div>
                            <span class="text-xs font-bold text-gold-700">{{ $selectedProperty->formatted_price }}</span>
                        </div>
                    @endif

                    <form action="{{ route('inquiry.store') }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="type" value="valuation_request">
                        @if($selectedProperty)
                            <input type="hidden" name="property_id" value="{{ $selectedProperty->id }}">
                        @endif

                        <!-- Section 1: Client Info -->
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-forest-900 mb-4 flex items-center gap-2">
                                <span class="w-5 h-[2px] bg-gold-400"></span> 1. Client Identity
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Full Name *</label>
                                    <input type="text" name="name" required placeholder="e.g. Alhaji Mustapha Ibrahim" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none transition-all">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Organization</label>
                                    <input type="text" name="organization" placeholder="e.g. First Bank Plc / AMCON" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none transition-all">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Email *</label>
                                    <input type="email" name="email" required placeholder="contact@organization.ng" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none transition-all">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Phone *</label>
                                    <input type="text" name="phone" required placeholder="0803 000 0000" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none transition-all">
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Asset Details -->
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-forest-900 mb-4 flex items-center gap-2">
                                <span class="w-5 h-[2px] bg-gold-400"></span> 2. Asset Particulars
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Asset Classification *</label>
                                    <select name="asset_type" required class="w-full px-3.5 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none bg-white transition-all">
                                        <option value="Commercial High-Rise / Office Building">Commercial / Office</option>
                                        <option value="Industrial Plant / Factory & Machinery">Industrial Plant / Factory</option>
                                        <option value="Oil & Gas Petroleum Tank Farm / Jetty">Oil & Gas / Tank Farm</option>
                                        <option value="Residential Estate / Luxury Mansions">Residential / Estate</option>
                                        <option value="Agricultural Farmland & Processing Mills">Agricultural / Farmland</option>
                                        <option value="Infrastructure Right-of-Way Corridor">Infrastructure / ROW</option>
                                        <option value="Moveable Assets (Motor Fleet & Equipment)">Moveable Assets / Fleet</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Valuation Purpose *</label>
                                    <select name="service_category" required class="w-full px-3.5 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none bg-white transition-all">
                                        <option value="Mortgage / Collateral Security">Mortgage / Collateral</option>
                                        <option value="Balance Sheet & Auditing Statement">Balance Sheet / Audit</option>
                                        <option value="Insurance Replacement Valuation">Insurance Replacement</option>
                                        <option value="Compulsory Acquisition & Compensation">Compulsory Acquisition</option>
                                        <option value="Mergers, Acquisitions & Liquidation">M&A / Liquidation</option>
                                        <option value="Feasibility / Investment Appraisal">Feasibility Study</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Asset Location *</label>
                                    <input type="text" name="asset_location" required placeholder="e.g. Victoria Island, Lagos" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none transition-all">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Preferred Office</label>
                                    <select name="preferred_branch" class="w-full px-3.5 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none bg-white transition-all">
                                        <option value="Kaduna Operational Head Office">Kaduna HQ</option>
                                        <option value="Abuja Regional Office">Abuja Office</option>
                                        <option value="Abia State Branch">Abia State</option>
                                        <option value="USA Link Representative">USA Desk (Detroit)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Details -->
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-forest-900 mb-4 flex items-center gap-2">
                                <span class="w-5 h-[2px] bg-gold-400"></span> 3. Specific Instructions
                            </h3>
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Brief Description & Deliverables *</label>
                                <textarea name="message" rows="4" required placeholder="Describe land size, building configuration, machinery count, date required, and any existing title documents..." class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-forest-700 focus:outline-none transition-all resize-none"></textarea>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="pt-2 text-center">
                            <button type="submit" class="w-full sm:w-auto px-10 py-4 rounded-xl bg-forest-900 hover:bg-forest-800 text-white font-bold text-[11px] uppercase tracking-wider transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98] inline-flex items-center justify-center gap-2">
                                <i class="fa-solid fa-stamp text-gold-400"></i> Submit Valuation Brief
                            </button>
                            <p class="text-[11px] text-slate-400 mt-3">
                                All information treated under strict non-disclosure per ESVRBON professional ethics.
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
