@extends('layouts.admin')

@section('title', 'Add Team Member')
@section('header_title', 'Add Surveyor / Partner')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
    <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Full Name & Title *</label>
                <input type="text" name="name" required placeholder="e.g. Chief O. A. Nnaji" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Designation / Role *</label>
                <input type="text" name="designation" required placeholder="e.g. Principal Partner" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Cadre (FNIVS, ANIVS)</label>
                <input type="text" name="cadre" placeholder="e.g. Fellow (FNIVS)" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Registration No</label>
                <input type="text" name="registration_no" placeholder="e.g. F231" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Experience Years</label>
                <input type="text" name="experience_years" placeholder="e.g. 40+ Years" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Branch Office</label>
                <input type="text" name="branch_location" placeholder="e.g. Kaduna Head Office" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Phone</label>
                <input type="text" name="phone" placeholder="0803 504 4633" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Email</label>
                <input type="email" name="email" placeholder="nnajioacompany@gmail.com" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
            </div>
        </div>

        <!-- Avatar Upload -->
        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-2">
            <label class="block text-xs font-bold text-slate-800 mb-1">
                <i class="fa-solid fa-cloud-arrow-up text-gold-600 mr-1"></i> Upload Portrait Photo (Auto-Optimized & Secure)
            </label>
            <input type="file" name="avatar_file" accept=".jpg,.jpeg,.png,.webp" class="block w-full text-xs text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-forest-900 file:text-gold-300 hover:file:bg-forest-800 cursor-pointer">
            <p class="text-[11px] text-slate-500">Upload portrait photo (.jpg, .png, .webp). Automatically resized and optimized.</p>
            <div class="pt-2 border-t border-slate-200">
                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Or paste image URL:</label>
                <input type="url" name="avatar" placeholder="https://..." class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-xs focus:ring-2 focus:ring-forest-800 bg-white">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Academic & Professional Qualifications</label>
            <input type="text" name="qualifications" placeholder="e.g. B.Sc (Hons) Estate Mgt (UNN 1974), FNIVS, RSV" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Full Biography & Experience Summary *</label>
            <textarea name="bio" rows="5" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800"></textarea>
        </div>

        <div class="flex items-center space-x-2">
            <input type="checkbox" name="is_partner" id="is_partner" value="1" class="rounded text-forest-900 focus:ring-forest-800">
            <label for="is_partner" class="text-xs font-bold text-slate-700">Executive Partner (Show in Executive Tier)</label>
        </div>

        <div class="pt-4 flex items-center justify-end space-x-4">
            <a href="{{ route('admin.team.index') }}" class="px-5 py-2 rounded-xl border border-slate-300 text-slate-700 text-xs font-bold">Cancel</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-forest-900 text-white font-bold text-xs uppercase shadow">Save Member Profile</button>
        </div>
    </form>
</div>
@endsection
