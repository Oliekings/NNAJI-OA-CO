<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Active Listings Page (Automated filtering: only active properties)
     */
    public function index(Request $request)
    {
        $query = Property::active();

        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('property_type', $request->type);
        }

        if ($request->filled('listing_type') && $request->listing_type !== 'all') {
            $query->where('listing_type', $request->listing_type);
        }

        if ($request->filled('location')) {
            $loc = $request->location;
            $query->where(function ($q) use ($loc) {
                $q->where('location_city', 'like', "%{$loc}%")
                  ->orWhere('location_state', 'like', "%{$loc}%")
                  ->orWhere('location_address', 'like', "%{$loc}%");
            });
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float)$request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float)$request->max_price);
        }

        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('reference_no', 'like', "%{$searchTerm}%");
            });
        }

        $sort = $request->get('sort', 'latest');
        match ($sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'oldest' => $query->orderBy('created_at', 'asc'),
            default => $query->orderBy('is_featured', 'desc')->latest(),
        };

        $properties = $query->paginate(9)->withQueryString();
        $propertyTypes = Property::distinct()->pluck('property_type')->filter();
        $cities = Property::distinct()->pluck('location_city')->filter();

        return view('pages.properties.index', compact('properties', 'propertyTypes', 'cities'));
    }

    /**
     * Single Property View
     */
    public function show($slug)
    {
        $property = Property::where('slug', $slug)->firstOrFail();
        $relatedProperties = Property::where('id', '!=', $property->id)
            ->where('property_type', $property->property_type)
            ->take(3)
            ->get();

        return view('pages.properties.show', compact('property', 'relatedProperties'));
    }

    /**
     * Closed Deals / Portfolio Archive Page
     * (Automated property lifecycle destination when status = 'sold', 'leased', 'valuation_closed')
     */
    public function portfolio(Request $request)
    {
        $query = Property::closedDeals();

        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('property_type', $request->type);
        }

        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('client_name', 'like', "%{$searchTerm}%")
                  ->orWhere('transaction_summary', 'like', "%{$searchTerm}%")
                  ->orWhere('location_city', 'like', "%{$searchTerm}%");
            });
        }

        $closedDeals = $query->latest('sold_date')->latest()->paginate(9)->withQueryString();
        $totalValuationVolume = Property::closedDeals()->sum('sold_price');
        $totalTransactionsCount = Property::closedDeals()->count();

        return view('pages.properties.portfolio', compact(
            'closedDeals',
            'totalValuationVolume',
            'totalTransactionsCount'
        ));
    }
}
