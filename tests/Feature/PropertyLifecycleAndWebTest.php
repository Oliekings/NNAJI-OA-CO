<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\User;
use App\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyLifecycleAndWebTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_public_pages_render_successfully()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('NNAJI O.A & COMPANY', false);
        $response->assertSee('50B+');

        $response = $this->get('/properties');
        $response->assertStatus(200);
        $response->assertSee('Active Property Listings');

        $response = $this->get('/portfolio');
        $response->assertStatus(200);
        $response->assertSee('Closed Deals');

        $response = $this->get('/services');
        $response->assertStatus(200);
        $response->assertSee('Professional Services');

        $response = $this->get('/about');
        $response->assertStatus(200);
        $response->assertSee('424962'); // CAC reg

        $response = $this->get('/team');
        $response->assertStatus(200);
        $response->assertSee('ESV Nnaji Nnamdi Ikechukwu');
        $response->assertSee('FL1143');
        $response->assertSee('Chief Ogwuegbu Agomoh Nnaji');
        $response->assertSee('Fakaa Tersoo Matthew');
        $response->assertSee('ESV Sabe Terungwa');

        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('Kaduna Head Office');
        $response->assertSee('Prince and Princess Estate');
        $response->assertSee('08037002395');
        $response->assertSee('08187666130');

        $response = $this->get('/request-valuation');
        $response->assertStatus(200);
        $response->assertSee('Request Statutory Asset Valuation');
    }

    public function test_property_lifecycle_automation_routes_sold_property_to_closed_deals()
    {
        $admin = User::first();

        // 1. Create an active property
        $property = Property::create([
            'title' => 'Test Commercial Plaza In Kaduna',
            'property_type' => 'Commercial',
            'listing_type' => 'for_sale',
            'price' => 500000000,
            'location_city' => 'Kaduna',
            'location_state' => 'Kaduna State',
            'description' => 'A prime test commercial property.',
            'status' => 'available',
        ]);

        // Verify it appears in active listings
        $this->assertTrue(Property::active()->where('id', $property->id)->exists());
        $this->assertFalse(Property::closedDeals()->where('id', $property->id)->exists());

        // 2. Admin toggles status to 'sold' via lifecycle endpoint
        $response = $this->actingAs($admin)->post(route('admin.properties.toggle-status', $property->id), [
            'status' => 'sold',
            'transaction_summary' => 'Sold to institutional pension fund.',
        ]);

        $response->assertSessionHas('success');

        // 3. Verify it is now automated into closed deals and no longer in active listings
        $property->refresh();
        $this->assertEquals('sold', $property->status);
        $this->assertFalse(Property::active()->where('id', $property->id)->exists());
        $this->assertTrue(Property::closedDeals()->where('id', $property->id)->exists());

        // Check public portfolio response
        $portfolioResponse = $this->get('/portfolio');
        $portfolioResponse->assertStatus(200);
        $portfolioResponse->assertSee('Test Commercial Plaza In Kaduna');
    }

    public function test_client_inquiry_submission()
    {
        $payload = [
            'type' => 'valuation_request',
            'name' => 'Alhaji Sanusi Dantata',
            'email' => 'dantata@example.com',
            'phone' => '08031234567',
            'organization' => 'Dantata Oil & Gas',
            'service_category' => 'Property & Asset Valuation',
            'asset_type' => 'Industrial Plant / Factory & Machinery',
            'asset_location' => 'Kakuri, Kaduna',
            'preferred_branch' => 'Kaduna Operational Head Office',
            'message' => 'Need full plant and machinery valuation for mortgage refinancing.',
        ];

        $response = $this->post('/inquiry', $payload);
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('inquiries', [
            'email' => 'dantata@example.com',
            'name' => 'Alhaji Sanusi Dantata',
            'status' => 'new',
        ]);
    }

    public function test_multi_currency_property_listings()
    {
        $usdProperty = Property::create([
            'title' => 'Diplomatic Residence in Maitama (USD)',
            'property_type' => 'Residential',
            'listing_type' => 'for_sale',
            'price' => 2500000.00,
            'price_prefix' => '$',
            'price_unit' => 'net',
            'location_city' => 'Abuja',
            'location_state' => 'Abuja FCT',
            'description' => 'Luxury diplomatic residence offered in US Dollars.',
            'status' => 'available',
        ]);

        $eurProperty = Property::create([
            'title' => 'Commercial European Headquarters (EUR)',
            'property_type' => 'Commercial',
            'listing_type' => 'for_lease',
            'price' => 450000.00,
            'price_prefix' => '€',
            'price_unit' => 'per annum',
            'location_city' => 'Victoria Island',
            'location_state' => 'Lagos',
            'description' => 'Grade A commercial hub offered in Euros.',
            'status' => 'available',
        ]);

        $gbpProperty = Property::create([
            'title' => 'Mayfair-Style Penthouse (GBP)',
            'property_type' => 'Residential',
            'listing_type' => 'for_sale',
            'price' => 1200000.00,
            'price_prefix' => '£',
            'price_unit' => 'total',
            'location_city' => 'Ikoyi',
            'location_state' => 'Lagos',
            'description' => 'Executive penthouse offered in British Pounds.',
            'status' => 'available',
        ]);

        $this->assertEquals('$2,500,000 net', $usdProperty->formatted_price);
        $this->assertEquals('€450,000 per annum', $eurProperty->formatted_price);
        $this->assertEquals('£1,200,000 total', $gbpProperty->formatted_price);

        $response = $this->get('/properties/' . $usdProperty->slug);
        $response->assertStatus(200);
        $response->assertSee('$2,500,000 net');
    }

    public function test_video_media_property_listing()
    {
        $videoProperty = Property::create([
            'title' => 'Prime Industrial Tank Farm with Aerial Video',
            'property_type' => 'Industrial',
            'listing_type' => 'for_sale',
            'price' => 8500000000.00,
            'price_prefix' => '₦',
            'price_unit' => 'total',
            'location_city' => 'Calabar',
            'location_state' => 'Cross River',
            'description' => 'Industrial deep water port tank farm with dedicated jetty and video walkthrough.',
            'video_url' => '/storage/properties/videos/test-tank-farm.mp4',
            'video_thumbnail' => '/storage/properties/videos/test-tank-farm-thumb.webp',
            'status' => 'available',
        ]);

        $this->assertTrue($videoProperty->has_video);
        $this->assertStringContainsString('test-tank-farm-thumb.webp', $videoProperty->display_cover);

        $response = $this->get('/properties/' . $videoProperty->slug);
        $response->assertStatus(200);
        $response->assertSee('test-tank-farm.mp4');
    }

    public function test_title_document_field_and_custom_options()
    {
        $property = Property::create([
            'title' => 'Prime Waterfront Commercial Plot with Governor Consent',
            'property_type' => 'Land',
            'listing_type' => 'for_sale',
            'price' => 1500000000.00,
            'location_city' => 'Victoria Island',
            'location_state' => 'Lagos',
            'title_document' => "Governor's Consent & Registered Deed",
            'description' => 'Direct prime commercial waterfront land ready for high-rise tower construction.',
            'status' => 'available',
        ]);

        $this->assertEquals("Governor's Consent & Registered Deed", $property->title_document);

        $response = $this->get('/properties/' . $property->slug);
        $response->assertStatus(200);
        $response->assertSee("Governor's Consent & Registered Deed");
    }
}
