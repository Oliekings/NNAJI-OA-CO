<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Inquiry;
use App\Models\TeamMember;
use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $activeListingsCount = Property::active()->count();
        $closedDealsCount = Property::closedDeals()->count();
        $totalValuationVolume = Property::closedDeals()->sum('sold_price');
        $newInquiriesCount = Inquiry::where('status', 'new')->count();
        $totalInquiriesCount = Inquiry::count();

        $recentInquiries = Inquiry::latest()->take(5)->get();
        $recentProperties = Property::latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'activeListingsCount',
            'closedDealsCount',
            'totalValuationVolume',
            'newInquiriesCount',
            'totalInquiriesCount',
            'recentInquiries',
            'recentProperties'
        ));
    }
}
