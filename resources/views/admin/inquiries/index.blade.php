@extends('layouts.admin')

@section('title', 'Client Inquiries & Leads')
@section('header_title', 'Client Inquiries & Leads')
@section('header_subtitle', 'Statutory valuation briefs, inspection bookings & general correspondence')

@section('content')
<div class="space-y-6">

    <!-- Filters -->
    <div class="flex items-center space-x-2 bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
        <a href="{{ route('admin.inquiries.index') }}" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition {{ !request('status') ? 'bg-forest-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
            All Inquiries ({{ $inquiries->total() }})
        </a>
        <a href="{{ route('admin.inquiries.index', ['status' => 'new']) }}" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition {{ request('status') === 'new' ? 'bg-forest-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
            <span class="w-2 h-2 rounded-full bg-red-500 inline-block mr-1"></span> New / Pending ({{ $newCount }})
        </a>
        <a href="{{ route('admin.inquiries.index', ['status' => 'contacted']) }}" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition {{ request('status') === 'contacted' ? 'bg-forest-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
            Contacted
        </a>
        <a href="{{ route('admin.inquiries.index', ['status' => 'completed']) }}" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition {{ request('status') === 'completed' ? 'bg-forest-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
            Completed
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-[11px] font-bold uppercase text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="p-4">Client / Organization</th>
                        <th class="p-4">Inquiry Category</th>
                        <th class="p-4">Asset Details & Location</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Date</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($inquiries as $inquiry)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4">
                                <strong class="text-slate-900 block text-sm">{{ $inquiry->name }}</strong>
                                <span class="text-slate-500">{{ $inquiry->organization ?? 'Private Client' }}</span>
                                <div class="text-[11px] text-slate-400 mt-0.5">
                                    <span><i class="fa-solid fa-phone text-[10px] mr-1"></i> {{ $inquiry->phone }}</span> &bull; 
                                    <span>{{ $inquiry->email }}</span>
                                </div>
                            </td>

                            <td class="p-4">
                                <span class="font-bold text-forest-900 uppercase block text-[11px]">{{ str_replace('_', ' ', $inquiry->type) }}</span>
                                <span class="text-slate-500 text-[11px]">{{ $inquiry->service_category ?? 'General' }}</span>
                            </td>

                            <td class="p-4">
                                <span class="text-slate-800 font-medium block">{{ $inquiry->asset_type ?? ($inquiry->property ? $inquiry->property->title : 'N/A') }}</span>
                                <span class="text-slate-400 text-[11px]">{{ $inquiry->asset_location ?? ($inquiry->preferred_branch ?? '') }}</span>
                            </td>

                            <td class="p-4">
                                <span class="px-2.5 py-1 text-[10px] font-bold rounded-full {{ $inquiry->status_badge_class }}">
                                    {{ ucfirst($inquiry->status) }}
                                </span>
                            </td>

                            <td class="p-4 text-slate-500 font-mono text-[11px]">
                                {{ $inquiry->created_at->format('M d, Y H:i') }}
                            </td>

                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" class="px-3 py-1.5 rounded-lg bg-forest-900 text-white font-bold text-xs hover:bg-forest-800 transition">
                                        Review Lead
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-400">
                                No inquiries recorded.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $inquiries->links() }}
        </div>
    </div>

</div>
@endsection
