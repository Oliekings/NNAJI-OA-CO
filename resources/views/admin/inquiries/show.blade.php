@extends('layouts.admin')

@section('title', 'Inquiry Dossier')
@section('header_title', 'Client Lead Dossier')
@section('header_subtitle', 'Review particulars, update status, and manage partner notes')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 space-y-6">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-slate-100 gap-4">
            <div>
                <span class="text-xs uppercase font-bold tracking-widest text-gold-700 block">Lead Reference: INQ-{{ str_pad($inquiry->id, 5, '0', STR_PAD_LEFT) }}</span>
                <h2 class="text-2xl font-bold text-slate-900 mt-1">{{ $inquiry->name }}</h2>
                <span class="text-xs text-slate-500">{{ $inquiry->organization ?? 'Private Individual Client' }} &bull; Submitted {{ $inquiry->created_at->format('F d, Y \a\t h:i A') }}</span>
            </div>
            <div>
                <span class="px-3 py-1.5 text-xs font-bold rounded-full {{ $inquiry->status_badge_class }}">
                    Status: {{ strtoupper($inquiry->status) }}
                </span>
            </div>
        </div>

        <!-- Contact Particulars -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                <span class="text-[10px] text-slate-400 block uppercase font-bold">Email Address</span>
                <a href="mailto:{{ $inquiry->email }}" class="text-sm font-bold text-forest-900 hover:underline">{{ $inquiry->email }}</a>
            </div>
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                <span class="text-[10px] text-slate-400 block uppercase font-bold">Phone Number</span>
                <a href="tel:{{ $inquiry->phone }}" class="text-sm font-bold text-forest-900 font-mono">{{ $inquiry->phone }}</a>
            </div>
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                <span class="text-[10px] text-slate-400 block uppercase font-bold">Assigned Branch Desk</span>
                <span class="text-sm font-bold text-slate-800">{{ $inquiry->preferred_branch ?? 'Kaduna / Abuja HQ' }}</span>
            </div>
        </div>

        <!-- Asset & Valuation Scope -->
        <div class="bg-forest-50/60 rounded-xl p-6 border border-forest-100 space-y-3 text-xs text-slate-800">
            <h4 class="font-bold text-forest-950 text-sm uppercase tracking-wider">Mandate Requirements & Classification</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <span class="text-slate-500 block">Service Category:</span>
                    <strong class="text-forest-900">{{ $inquiry->service_category ?? 'General Property Inquiry' }}</strong>
                </div>
                <div>
                    <span class="text-slate-500 block">Asset Type:</span>
                    <strong class="text-forest-900">{{ $inquiry->asset_type ?? 'N/A' }}</strong>
                </div>
                <div>
                    <span class="text-slate-500 block">Asset Location:</span>
                    <strong class="text-forest-900">{{ $inquiry->asset_location ?? 'Not specified' }}</strong>
                </div>
                @if($inquiry->property)
                    <div>
                        <span class="text-slate-500 block">Attached Property Listing:</span>
                        <a href="{{ route('properties.show', $inquiry->property->slug) }}" target="_blank" class="text-forest-900 font-bold underline">
                            {{ $inquiry->property->title }} ({{ $inquiry->property->reference_no }})
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Message Body -->
        <div>
            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Client Brief / Message</h4>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 text-sm leading-relaxed whitespace-pre-line">
                {{ $inquiry->message }}
            </div>
        </div>

        <!-- Action / Status Update Form -->
        <form action="{{ route('admin.inquiries.update', $inquiry->id) }}" method="POST" class="pt-6 border-t border-slate-100 space-y-4">
            @csrf
            @method('PATCH')

            <h4 class="text-xs font-bold uppercase tracking-wider text-forest-900">Process Lead & Update Administrative Record</h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Update Status</label>
                    <select name="status" class="w-full px-3 py-2.5 rounded-xl border border-slate-300 text-xs font-bold focus:ring-2 focus:ring-forest-800 bg-white">
                        <option value="new" {{ $inquiry->status === 'new' ? 'selected' : '' }}>New / Pending Action</option>
                        <option value="in_review" {{ $inquiry->status === 'in_review' ? 'selected' : '' }}>In Review by Partner</option>
                        <option value="contacted" {{ $inquiry->status === 'contacted' ? 'selected' : '' }}>Contacted Client / Proposal Sent</option>
                        <option value="completed" {{ $inquiry->status === 'completed' ? 'selected' : '' }}>Completed / Executed Mandate</option>
                        <option value="archived" {{ $inquiry->status === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Internal Surveyor Notes</label>
                <textarea name="admin_notes" rows="3" placeholder="Add internal notes regarding phone call outcomes, quote amount, or surveyor assigned..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-forest-800">{{ old('admin_notes', $inquiry->admin_notes) }}</textarea>
            </div>

            <div class="flex items-center justify-between pt-2">
                <a href="{{ route('admin.inquiries.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-800">&larr; Back to Inquiries</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-forest-900 hover:bg-forest-800 text-white font-bold text-xs uppercase tracking-wider shadow">
                    Save Record Updates
                </button>
            </div>
        </form>

    </div>

</div>
@endsection
