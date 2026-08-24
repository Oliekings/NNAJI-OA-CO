<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProperties = Property::active()->featured()->latest()->take(6)->get();
        if ($featuredProperties->isEmpty()) {
            $featuredProperties = Property::active()->latest()->take(6)->get();
        }

        $services = Service::active()->take(6)->get();
        $partners = TeamMember::partners()->get();
        $closedDealsCount = Property::closedDeals()->count();
        $activePropertiesCount = Property::active()->count();

        // Sample closed deals spotlight for track record proof
        $spotlightClosedDeals = Property::closedDeals()->take(3)->get();

        return view('pages.home', compact(
            'featuredProperties',
            'services',
            'partners',
            'closedDealsCount',
            'activePropertiesCount',
            'spotlightClosedDeals'
        ));
    }
}
