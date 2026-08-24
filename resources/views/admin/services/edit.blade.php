@extends('layouts.admin')

@section('title', 'Edit Service')
@section('header_title', 'Edit Practice Area')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Service Title *</label>
            <input type="text" name="title" value="{{ old('title', $service->title) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Track Record Subtitle</label>
            <input type="text" name="subtitle" value="{{ old('subtitle', $service->subtitle) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">FontAwesome Icon Class</label>
            <input type="text" name="icon" value="{{ old('icon', $service->icon) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Short Description *</label>
            <textarea name="short_description" rows="2" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">{{ old('short_description', $service->short_description) }}</textarea>
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Full Scope Description *</label>
            <textarea name="full_description" rows="5" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">{{ old('full_description', $service->full_description) }}</textarea>
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Scope of Work (Newline separated)</label>
            <textarea name="scope_of_work" rows="4" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">{{ old('scope_of_work', is_array($service->scope_of_work) ? implode("\n", $service->scope_of_work) : '') }}</textarea>
        </div>
        <div class="pt-4 flex items-center justify-end space-x-4">
            <a href="{{ route('admin.services.index') }}" class="px-5 py-2 rounded-xl border border-slate-300 text-slate-700 text-xs font-bold">Cancel</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-forest-900 text-white font-bold text-xs uppercase shadow">Update Service</button>
        </div>
    </form>
</div>
@endsection
