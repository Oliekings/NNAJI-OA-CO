<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Service;
use App\Models\Property;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $services = Service::active()->get();
        return view('pages.contact', compact('services'));
    }

    public function requestValuation(Request $request)
    {
        $services = Service::active()->get();
        $selectedProperty = null;
        if ($request->filled('property_id')) {
            $selectedProperty = Property::find($request->property_id);
        }
        return view('pages.request-valuation', compact('services', 'selectedProperty'));
    }

    public function storeInquiry(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'organization' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'service_category' => 'nullable|string|max:255',
            'asset_type' => 'nullable|string|max:255',
            'asset_location' => 'nullable|string|max:255',
            'preferred_branch' => 'nullable|string|max:255',
            'message' => 'required|string',
            'property_id' => 'nullable|exists:properties,id',
        ]);

        $inquiry = Inquiry::create($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your inquiry has been received. A senior surveyor from NNAJI O.A & COMPANY will contact you shortly.',
                'reference_id' => 'INQ-' . str_pad($inquiry->id, 5, '0', STR_PAD_LEFT),
            ]);
        }

        return back()->with('success', 'Thank you! Your request has been recorded. Our senior surveyor will contact you promptly.');
    }
}
