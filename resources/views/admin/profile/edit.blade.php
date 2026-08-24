@extends('layouts.admin')

@section('title', 'Admin Account & Security')
@section('header_title', 'Account Settings & Password')
@section('header_subtitle', 'Manage administrative credentials and security settings')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">

    <!-- Card 1: Change Password -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-forest-900 text-gold-400 flex items-center justify-center text-sm shadow-sm">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900">Change Admin Password</h3>
                    <p class="text-xs text-slate-500">Ensure your account is using a long, random password to stay secure.</p>
                </div>
            </div>
            <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                Security Active
            </span>
        </div>

        @if($errors->has('current_password') || $errors->has('password'))
            <div class="p-4 mb-6 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs space-y-1">
                @if($errors->has('current_password'))
                    <p><i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $errors->first('current_password') }}</p>
                @endif
                @if($errors->has('password'))
                    <p><i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $errors->first('password') }}</p>
                @endif
            </div>
        @endif

        <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-5 max-w-xl">
            @csrf
            @method('PUT')

            <!-- Current Password -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Current Password *</label>
                <div class="relative">
                    <input type="password" id="current_password" name="current_password" required placeholder="Enter current password" class="w-full px-4 py-2.5 pl-10 pr-10 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none bg-white">
                    <i class="fa-solid fa-lock absolute left-3.5 top-3 text-slate-400 text-xs"></i>
                    <button type="button" onclick="togglePass('current_password', this)" class="absolute right-3 top-2.5 text-slate-400 hover:text-slate-600 focus:outline-none">
                        <i class="fa-regular fa-eye text-xs"></i>
                    </button>
                </div>
            </div>

            <!-- New Password -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">New Password *</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required minlength="8" placeholder="Minimum 8 characters" class="w-full px-4 py-2.5 pl-10 pr-10 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none bg-white">
                    <i class="fa-solid fa-key absolute left-3.5 top-3 text-slate-400 text-xs"></i>
                    <button type="button" onclick="togglePass('password', this)" class="absolute right-3 top-2.5 text-slate-400 hover:text-slate-600 focus:outline-none">
                        <i class="fa-regular fa-eye text-xs"></i>
                    </button>
                </div>
                <p class="text-[11px] text-slate-500 mt-1">Must be at least 8 characters long.</p>
            </div>

            <!-- Confirm New Password -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Confirm New Password *</label>
                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8" placeholder="Re-type new password" class="w-full px-4 py-2.5 pl-10 pr-10 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none bg-white">
                    <i class="fa-solid fa-shield-check absolute left-3.5 top-3 text-slate-400 text-xs"></i>
                    <button type="button" onclick="togglePass('password_confirmation', this)" class="absolute right-3 top-2.5 text-slate-400 hover:text-slate-600 focus:outline-none">
                        <i class="fa-regular fa-eye text-xs"></i>
                    </button>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-forest-900 hover:bg-forest-800 text-white font-bold text-xs uppercase tracking-wider transition shadow flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk text-gold-400"></i> Update Password
                </button>
            </div>
        </form>
    </div>

    <!-- Card 2: Profile Information -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <div class="flex items-center space-x-3 pb-4 border-b border-slate-100 mb-6">
            <div class="w-10 h-10 rounded-xl bg-forest-900 text-gold-400 flex items-center justify-center text-sm shadow-sm">
                <i class="fa-solid fa-user-gear"></i>
            </div>
            <div>
                <h3 class="text-base font-bold text-slate-900">Administrator Profile</h3>
                <p class="text-xs text-slate-500">Update your administrative name and notification email.</p>
            </div>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-4 max-w-xl">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Admin Full Name *</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Admin Login Email *</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-800 focus:outline-none">
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs uppercase tracking-wider transition shadow flex items-center gap-2">
                    <i class="fa-solid fa-check text-gold-400"></i> Save Profile Details
                </button>
            </div>
        </form>
    </div>

</div>

<script>
function togglePass(id, btn) {
    const input = document.getElementById(id);
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>
@endsection
