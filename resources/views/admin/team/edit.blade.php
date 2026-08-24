@extends('layouts.admin')

@section('title', 'Edit Team Member')
@section('header_title', 'Edit Member Profile')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
    <form action="{{ route('admin.team.update', $member->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Full Name & Title *</label>
                <input type="text" name="name" value="{{ old('name', $member->name) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Designation / Role *</label>
                <input type="text" name="designation" value="{{ old('designation', $member->designation) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Cadre (FNIVS, ANIVS)</label>
                <input type="text" name="cadre" value="{{ old('cadre', $member->cadre) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Registration No</label>
                <input type="text" name="registration_no" value="{{ old('registration_no', $member->registration_no) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Experience Years</label>
                <input type="text" name="experience_years" value="{{ old('experience_years', $member->experience_years) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Branch Office</label>
                <input type="text" name="branch_location" value="{{ old('branch_location', $member->branch_location) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $member->phone) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $member->email) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
            </div>
        </div>

        <!-- Avatar Upload with Preview -->
        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-3">
            @if($member->avatar)
                <div class="flex items-center space-x-3 p-2.5 bg-white rounded-lg border border-slate-200">
                    <img src="{{ $member->avatar }}" alt="{{ $member->name }}" class="w-12 h-12 object-cover rounded-full border border-slate-200">
                    <div>
                        <span class="text-[10px] font-bold uppercase text-slate-500 block">Current Portrait</span>
                        <span class="text-xs text-forest-900 font-medium truncate block max-w-sm">{{ $member->avatar }}</span>
                    </div>
                </div>
            @endif

            <div>
                <label class="block text-xs font-bold text-slate-800 mb-1">
                    <i class="fa-solid fa-cloud-arrow-up text-gold-600 mr-1"></i> Upload New Portrait Photo (Auto-Optimized & Secure)
                </label>
                <input type="file" name="avatar_file" accept=".jpg,.jpeg,.png,.webp" class="block w-full text-xs text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-forest-900 file:text-gold-300 hover:file:bg-forest-800 cursor-pointer">
                <p class="text-[11px] text-slate-500 mt-1">Upload portrait photo (.jpg, .png, .webp). Automatically resized and optimized.</p>
            </div>

            <div class="pt-2 border-t border-slate-200">
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Or direct image URL:</label>
                <input type="url" name="avatar" value="{{ old('avatar', $member->avatar) }}" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-xs focus:ring-2 focus:ring-forest-800 bg-white">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Academic & Professional Qualifications</label>
            <input type="text" name="qualifications" value="{{ old('qualifications', $member->qualifications) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Full Biography & Experience Summary *</label>
            <textarea name="bio" rows="5" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">{{ old('bio', $member->bio) }}</textarea>
        </div>

        <div class="flex items-center space-x-2">
            <input type="checkbox" name="is_partner" id="is_partner" value="1" {{ old('is_partner', $member->is_partner) ? 'checked' : '' }} class="rounded text-forest-900 focus:ring-forest-800">
            <label for="is_partner" class="text-xs font-bold text-slate-700">Executive Partner (Show in Executive Tier)</label>
        </div>

        <div class="pt-4 flex items-center justify-end space-x-4">
            <a href="{{ route('admin.team.index') }}" class="px-5 py-2 rounded-xl border border-slate-300 text-slate-700 text-xs font-bold">Cancel</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-forest-900 text-white font-bold text-xs uppercase shadow">Update Profile</button>
        </div>
    </form>
</div>
@endsection
