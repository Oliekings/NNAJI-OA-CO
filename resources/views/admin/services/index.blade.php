@extends('layouts.admin')

@section('title', 'Manage Services')
@section('header_title', 'Practice Areas & Services')
@section('header_subtitle', 'Manage valuation disciplines and service offerings')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
        <h3 class="text-sm font-bold text-slate-900">Corporate Practice Disciplines ({{ $services->count() }})</h3>
        <a href="{{ route('admin.services.create') }}" class="px-4 py-2 rounded-xl bg-forest-900 hover:bg-forest-800 text-white font-bold text-xs uppercase tracking-wider transition shadow-sm">
            <i class="fa-solid fa-plus mr-1.5 text-gold-400"></i> Add New Practice Service
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-left text-xs text-slate-700">
            <thead class="bg-slate-50 text-[11px] font-bold uppercase text-slate-500 border-b border-slate-200">
                <tr>
                    <th class="p-4">Practice Discipline</th>
                    <th class="p-4">Track Record Subtitle</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium">
                @foreach($services as $service)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-4 flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-forest-900 text-gold-400 flex items-center justify-center text-sm">
                                <i class="fa-solid {{ $service->icon ?? 'fa-landmark' }}"></i>
                            </div>
                            <div>
                                <strong class="text-slate-900 text-sm block">{{ $service->title }}</strong>
                                <span class="text-[11px] text-slate-500 font-mono">/services/{{ $service->slug }}</span>
                            </div>
                        </td>
                        <td class="p-4 text-slate-600">
                            {{ $service->subtitle }}
                        </td>
                        <td class="p-4">
                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-full {{ $service->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                                {{ $service->is_active ? 'Active' : 'Disabled' }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('services.show', $service->slug) }}" target="_blank" class="p-1.5 text-slate-400 hover:text-forest-900"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                <a href="{{ route('admin.services.edit', $service->id) }}" class="p-1.5 text-slate-400 hover:text-blue-600"><i class="fa-solid fa-pen-to-square"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
