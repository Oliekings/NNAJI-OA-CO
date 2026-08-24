@extends('layouts.admin')

@section('title', 'Manage Team & Surveyors')
@section('header_title', 'Partners & Registered Surveyors')
@section('header_subtitle', 'Manage partner CVs and cadastral registration numbers')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
        <h3 class="text-sm font-bold text-slate-900">Surveyors & Staff Directory ({{ $team->count() }})</h3>
        <a href="{{ route('admin.team.create') }}" class="px-4 py-2 rounded-xl bg-forest-900 hover:bg-forest-800 text-white font-bold text-xs uppercase tracking-wider transition shadow-sm">
            <i class="fa-solid fa-user-plus mr-1.5 text-gold-400"></i> Add Team Member
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-left text-xs text-slate-700">
            <thead class="bg-slate-50 text-[11px] font-bold uppercase text-slate-500 border-b border-slate-200">
                <tr>
                    <th class="p-4">Name & Designation</th>
                    <th class="p-4">Cadastral Cadre / Reg No</th>
                    <th class="p-4">Branch Office</th>
                    <th class="p-4">Experience</th>
                    <th class="p-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium">
                @foreach($team as $member)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-4 flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full overflow-hidden bg-forest-900 flex-shrink-0">
                                @if($member->avatar)
                                    <img src="{{ $member->avatar }}" alt="" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gold-400"><i class="fa-solid fa-user"></i></div>
                                @endif
                            </div>
                            <div>
                                <strong class="text-slate-900 text-sm block">{{ $member->name }}</strong>
                                <span class="text-slate-500 text-[11px]">{{ $member->designation }}</span>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="font-bold text-forest-900 block">{{ $member->cadre }}</span>
                            <span class="text-slate-400 font-mono text-[10px]">{{ $member->registration_no }}</span>
                        </td>
                        <td class="p-4 text-slate-600">
                            {{ $member->branch_location }}
                        </td>
                        <td class="p-4 text-slate-600 font-semibold">
                            {{ $member->experience_years }}
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('team.show', $member->slug) }}" target="_blank" class="p-1.5 text-slate-400 hover:text-forest-900"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                <a href="{{ route('admin.team.edit', $member->id) }}" class="p-1.5 text-slate-400 hover:text-blue-600"><i class="fa-solid fa-pen-to-square"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
