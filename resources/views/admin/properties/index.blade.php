@extends('layouts.admin')

@section('title', 'Property Management & Lifecycle')
@section('header_title', 'Properties & Deal Portfolio')
@section('header_subtitle', 'Manage active listings and automated closed deal transitions')

@section('content')
<div class="space-y-6">

    <!-- Top Action Bar & Filter Strip -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
        
        <!-- Filter Tabs -->
        <div class="flex items-center space-x-2">
            <a href="{{ route('admin.properties.index') }}" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition {{ !request('status') ? 'bg-forest-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                All ({{ $properties->total() }})
            </a>
            <a href="{{ route('admin.properties.index', ['status' => 'active']) }}" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition {{ request('status') === 'active' ? 'bg-forest-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                <i class="fa-solid fa-circle-check text-emerald-500 mr-1"></i> Active Listings ({{ $activeCount }})
            </a>
            <a href="{{ route('admin.properties.index', ['status' => 'closed']) }}" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition {{ request('status') === 'closed' ? 'bg-forest-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                <i class="fa-solid fa-trophy text-gold-500 mr-1"></i> Closed Deals / Portfolio ({{ $closedCount }})
            </a>
        </div>

        <!-- Add Button -->
        <div>
            <a href="{{ route('admin.properties.create') }}" class="px-4 py-2 rounded-xl bg-forest-900 hover:bg-forest-800 text-white font-bold text-xs uppercase tracking-wider transition shadow-sm inline-flex items-center">
                <i class="fa-solid fa-plus-circle mr-2 text-gold-400"></i> New Property Listing
            </a>
        </div>

    </div>

    <!-- Properties Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-[11px] font-bold uppercase text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="p-4">Property Particulars</th>
                        <th class="p-4">Type & Category</th>
                        <th class="p-4">Price / Value</th>
                        <th class="p-4">Lifecycle Status</th>
                        <th class="p-4">Automated Status Switcher</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($properties as $property)
                        <tr class="hover:bg-slate-50/80 transition">
                            
                            <!-- Particulars -->
                            <td class="p-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-14 h-14 rounded-xl bg-slate-100 overflow-hidden flex-shrink-0 border border-slate-200">
                                        @if($property->featured_image)
                                            <img src="{{ $property->featured_image }}" alt="" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-400"><i class="fa-solid fa-building"></i></div>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm leading-tight">{{ $property->title }}</h4>
                                        <div class="text-[11px] text-slate-500 mt-0.5">
                                            <span class="font-mono text-forest-900 font-semibold">{{ $property->reference_no }}</span> &bull; 
                                            <span>{{ $property->location_city }}, {{ $property->location_state }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Type -->
                            <td class="p-4">
                                <span class="block font-bold text-slate-900">{{ $property->property_type }}</span>
                                <span class="text-[11px] text-slate-500 uppercase">{{ str_replace('_', ' ', $property->listing_type) }}</span>
                            </td>

                            <!-- Price -->
                            <td class="p-4">
                                <span class="font-bold text-forest-950 text-sm">{{ $property->formatted_price }}</span>
                                @if($property->sold_price)
                                    <span class="block text-[10px] text-red-700 font-semibold">Sold: {{ $property->formatted_sold_price }}</span>
                                @endif
                            </td>

                            <!-- Status Badge -->
                            <td class="p-4">
                                <span class="px-2.5 py-1 text-[11px] font-bold rounded-full border {{ $property->status_badge_class }}">
                                    {{ $property->status_label }}
                                </span>
                                @if(in_array($property->status, ['sold', 'leased', 'valuation_closed']))
                                    <span class="block text-[10px] text-slate-400 mt-1"><i class="fa-solid fa-arrow-right-arrow-left text-[9px] mr-0.5"></i> In Closed Deals</span>
                                @else
                                    <span class="block text-[10px] text-emerald-600 mt-1"><i class="fa-solid fa-globe text-[9px] mr-0.5"></i> On Public Feed</span>
                                @endif
                            </td>

                            <!-- Lifecycle Automation Switcher Form -->
                            <td class="p-4">
                                <form action="{{ route('admin.properties.toggle-status', $property->id) }}" method="POST" class="flex items-center space-x-1.5">
                                    @csrf
                                    <select name="status" class="px-2.5 py-1.5 rounded-lg border border-slate-300 text-xs font-semibold focus:ring-2 focus:ring-forest-800 bg-white">
                                        <option value="available" {{ $property->status === 'available' ? 'selected' : '' }}>Active Listing</option>
                                        <option value="under_offer" {{ $property->status === 'under_offer' ? 'selected' : '' }}>Under Offer</option>
                                        <option value="sold" {{ $property->status === 'sold' ? 'selected' : '' }}>Sold (Route to Portfolio)</option>
                                        <option value="leased" {{ $property->status === 'leased' ? 'selected' : '' }}>Leased (Route to Portfolio)</option>
                                        <option value="valuation_closed" {{ $property->status === 'valuation_closed' ? 'selected' : '' }}>Valuation Completed</option>
                                    </select>
                                    <button type="submit" title="Apply Status & Auto-Route" class="px-2.5 py-1.5 rounded-lg bg-forest-900 hover:bg-forest-800 text-white text-xs font-bold">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                            </td>

                            <!-- Actions -->
                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('properties.show', $property->slug) }}" target="_blank" title="View on Site" class="p-1.5 text-slate-400 hover:text-forest-900 rounded-lg hover:bg-slate-100">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                    <a href="{{ route('admin.properties.edit', $property->id) }}" title="Edit Details" class="p-1.5 text-slate-400 hover:text-blue-600 rounded-lg hover:bg-slate-100">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this property listing?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Delete" class="p-1.5 text-slate-400 hover:text-red-600 rounded-lg hover:bg-slate-100">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-400">
                                No properties found under current filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 border-t border-slate-100">
            {{ $properties->links() }}
        </div>
    </div>

</div>
@endsection
