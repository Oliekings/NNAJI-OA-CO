@extends('layouts.admin')

@section('title', 'Overview Dashboard')
@section('header_title', 'Corporate Overview')
@section('header_subtitle', 'Estate Surveying, Valuation & Lifecycle Automation')

@section('content')
<div class="space-y-8">

    <!-- 1. Stats Overview Bar -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs uppercase font-bold tracking-wider text-slate-500 block">Active Listings</span>
                <span class="text-3xl font-bold text-forest-900 mt-1 block">{{ $activeListingsCount }}</span>
                <span class="text-[11px] text-emerald-600 font-semibold"><i class="fa-solid fa-circle-check"></i> Live on Public Site</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-forest-50 text-forest-800 flex items-center justify-center text-xl">
                <i class="fa-solid fa-building"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs uppercase font-bold tracking-wider text-slate-500 block">Closed Deals Archive</span>
                <span class="text-3xl font-bold text-red-800 mt-1 block">{{ $closedDealsCount }}</span>
                <span class="text-[11px] text-slate-500 font-semibold"><i class="fa-solid fa-trophy text-gold-500"></i> Auto-routed to Portfolio</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-red-50 text-red-700 flex items-center justify-center text-xl">
                <i class="fa-solid fa-award"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs uppercase font-bold tracking-wider text-slate-500 block">Portfolio Value</span>
                <span class="text-2xl font-bold text-forest-950 font-cinzel mt-1 block">₦{{ number_format($totalValuationVolume / 1000000000, 1) }}B+</span>
                <span class="text-[11px] text-slate-500 font-semibold">Valuation & Completed Deals</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-gold-100 text-gold-700 flex items-center justify-center text-xl">
                <i class="fa-solid fa-coins"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs uppercase font-bold tracking-wider text-slate-500 block">Client Leads</span>
                <span class="text-3xl font-bold text-blue-900 mt-1 block">{{ $totalInquiriesCount }}</span>
                @if($newInquiriesCount > 0)
                    <span class="text-[11px] text-red-600 font-bold"><i class="fa-solid fa-bell"></i> {{ $newInquiriesCount }} Pending Review</span>
                @else
                    <span class="text-[11px] text-slate-500 font-semibold">All Leads Processed</span>
                @endif
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-xl">
                <i class="fa-solid fa-inbox"></i>
            </div>
        </div>

    </div>

    <!-- 2. Property Lifecycle Automation Spotlight -->
    <div class="bg-gradient-to-r from-forest-900 to-forest-950 rounded-2xl p-6 text-white shadow-md flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="space-y-1">
            <div class="inline-flex items-center space-x-2 text-xs font-bold text-gold-300 uppercase tracking-widest">
                <i class="fa-solid fa-bolt-lightning text-gold-400"></i>
                <span>Automated Property Lifecycle Workflow</span>
            </div>
            <h3 class="text-lg font-bold text-white">How Status Transitions Work</h3>
            <p class="text-xs text-slate-300 max-w-2xl leading-relaxed">
                When a property status is toggled to <strong>"Sold"</strong> or <strong>"Leased"</strong> in the CMS, the system automatically delists it from the public active properties feed (<a href="{{ route('properties.index') }}" class="underline text-gold-300" target="_blank">/properties</a>) and immediately moves it into the permanent <strong>Closed Deals / Portfolio Archive</strong> (<a href="{{ route('properties.portfolio') }}" class="underline text-gold-300" target="_blank">/portfolio</a>).
            </p>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('admin.properties.index') }}" class="px-5 py-3 rounded-xl bg-gold-500 hover:bg-gold-400 text-forest-950 font-bold text-xs uppercase tracking-wider transition shadow">
                Manage Property Lifecycles &rarr;
            </a>
        </div>
    </div>

    <!-- 3. Recent Properties & Recent Inquiries -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Recent Properties (7 cols) -->
        <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-slate-900 text-sm">Recent Properties & Deals</h3>
                    <span class="text-xs text-slate-500">Live listings & closed transactions</span>
                </div>
                <a href="{{ route('admin.properties.index') }}" class="text-xs font-bold text-forest-900 hover:text-gold-700">View All</a>
            </div>

            <div class="divide-y divide-slate-100">
                @foreach($recentProperties as $prop)
                    <div class="p-4 flex items-center justify-between hover:bg-slate-50 transition">
                        <div class="flex items-center space-x-3 overflow-hidden">
                            <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0">
                                @if($prop->featured_image)
                                    <img src="{{ $prop->featured_image }}" alt="" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400"><i class="fa-solid fa-building"></i></div>
                                @endif
                            </div>
                            <div class="truncate">
                                <h4 class="text-xs font-bold text-slate-900 truncate">{{ $prop->title }}</h4>
                                <div class="text-[11px] text-slate-500">
                                    <span>{{ $prop->location_city }}</span> &bull; 
                                    <span class="font-bold text-forest-900">{{ $prop->formatted_price }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3 flex-shrink-0">
                            <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full {{ $prop->status_badge_class }}">
                                {{ $prop->status_label }}
                            </span>
                            <a href="{{ route('admin.properties.edit', $prop->id) }}" class="text-slate-400 hover:text-forest-900 text-xs">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Inquiries (5 cols) -->
        <div class="lg:col-span-5 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-slate-900 text-sm">Client Leads & Valuation Inquiries</h3>
                    <span class="text-xs text-slate-500">Incoming service requests</span>
                </div>
                <a href="{{ route('admin.inquiries.index') }}" class="text-xs font-bold text-forest-900 hover:text-gold-700">View All</a>
            </div>

            <div class="divide-y divide-slate-100">
                @forelse($recentInquiries as $inq)
                    <div class="p-4 hover:bg-slate-50 transition">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs font-bold text-slate-900">{{ $inq->name }}</span>
                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-full {{ $inq->status_badge_class }}">
                                {{ ucfirst($inq->status) }}
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-600 line-clamp-2">{{ $inq->message }}</p>
                        <div class="flex items-center justify-between mt-2 text-[10px] text-slate-400">
                            <span><i class="fa-solid fa-phone mr-1"></i> {{ $inq->phone }}</span>
                            <a href="{{ route('admin.inquiries.show', $inq->id) }}" class="text-forest-900 font-bold hover:underline">View Lead &rarr;</a>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-xs text-slate-400">No recent inquiries.</div>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
