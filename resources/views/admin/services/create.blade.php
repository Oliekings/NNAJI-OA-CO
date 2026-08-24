@extends('layouts.admin')

@section('title', 'Add Service')
@section('header_title', 'Add Practice Discipline')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
    <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Service Title *</label>
            <input type="text" name="title" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Track Record Subtitle</label>
            <input type="text" name="subtitle" placeholder="e.g. ₦50B+ in Certified Asset Valuations" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">FontAwesome Icon Class</label>
            <input type="text" name="icon" value="fa-calculator" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Short Description (Card snippet) *</label>
            <textarea name="short_description" rows="2" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800"></textarea>
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Full Scope Description *</label>
            <textarea name="full_description" rows="5" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800"></textarea>
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Scope of Work (Newline separated)</label>
            <textarea name="scope_of_work" rows="4" placeholder="Mortgage Valuation&#10;Insurance Appraisals" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800"></textarea>
        </div>
        <div class="pt-4 flex items-center justify-end space-x-4">
            <a href="{{ route('admin.services.index') }}" class="px-5 py-2 rounded-xl border border-slate-300 text-slate-700 text-xs font-bold">Cancel</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-forest-900 text-white font-bold text-xs uppercase shadow">Save Practice Service</button>
        </div>
    </form>
</div>
@endsection
