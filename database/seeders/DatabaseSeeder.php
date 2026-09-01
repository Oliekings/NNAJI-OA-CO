<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Default Administrator
        User::firstOrCreate(
            ['email' => 'admin@nnajioacompany.com'],
            [
                'name' => 'Principal Administrator',
                'password' => Hash::make('AdminNnaji2026!'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Seed Core Practice Services
        $services = [
            [
                'title' => 'Property & Asset Valuation',
                'slug' => 'property-valuation',
                'icon' => 'fa-calculator',
                'subtitle' => '₦50B+ in Certified Asset Valuations across Nigeria',
                'short_description' => 'Comprehensive statutory and commercial valuation for Land, Buildings, Industrial Plants, Machinery, Oil & Gas facilities, and Agricultural Investments.',
                'full_description' => 'NNAJI O.A & COMPANY undertakes valuation of properties and tangible assets throughout Nigeria in accordance with NIESV standards and ESVRBON regulations. Our valuation practice covers diverse purposes including Mortgage Financing, Insurance, Balance Sheet Auditing, Mergers & Acquisitions, Privatization, Capital Gains, Property Rating, and Compulsory Acquisition Compensation.',
                'scope_of_work' => [
                    'Mortgage & Bank Collateral Valuation',
                    'Insurance Replacement Cost Appraisals',
                    'Balance Sheet & Auditing Statement of Affairs',
                    'Compulsory Acquisition & Compensation for Infrastructure (Pipelines, Roads, Transmission Lines)',
                    'Mergers, Takeovers, and Corporate Splitting-Up',
                    'Plant, Machinery, Oil Tanks & Heavy Industrial Equipment Coding & Valuation',
                    'Agricultural & Agro-Allied Farm Land & Livestock Valuations',
                ],
                'asset_classes' => [
                    'Commercial High-Rises & Office Complexes',
                    'Industrial Plants, Breweries & Manufacturing Facilities',
                    'Oil & Gas Tank Farms, Rigs & Marine Assets',
                    'Residential Estates & Luxury Developments',
                    'Agricultural Farmlands & Processing Mills',
                    'Heavy Machinery, Vehicles & Equipment Inventories',
                ],
                'featured_image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80',
                'sort_order' => 1,
            ],
            [
                'title' => 'Property & Facility Management',
                'slug' => 'property-management',
                'icon' => 'fa-building-shield',
                'subtitle' => 'Over 100 Properties Managed | ₦3.3B+ Asset Portfolio',
                'short_description' => 'End-to-end management of commercial office towers, residential estates, retail centers, and institutional facilities maximizing net operating income.',
                'full_description' => 'Our Property and Facility Management Division handles high-value properties across Kaduna, Abuja, Lagos, and Abia. We ensure optimal capital preservation, high occupancy rates, proactive maintenance schedules, lease administration, and strict financial accounting.',
                'scope_of_work' => [
                    'Building Structure & External Works Maintenance',
                    'Tenant Vetting, Lease Administration & Rental Collection',
                    'Mechanical, Electrical & Technical Systems Maintenance',
                    'Security, Fire Safety & Access Control Management',
                    'Space Planning & Optimization for Corporate Occupiers',
                    'Preparation of Annual Service Charge Budgets & Audited Statements',
                ],
                'asset_classes' => [
                    'Multi-Storey Corporate Office Towers',
                    'Gated Residential Communities & Apartments',
                    'Commercial Shopping Malls & Plazas',
                    'Student Hostels & Educational Campuses',
                ],
                'featured_image' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?auto=format&fit=crop&w=1200&q=80',
                'sort_order' => 2,
            ],
            [
                'title' => 'Estate Agency & Brokerage',
                'slug' => 'estate-agency',
                'icon' => 'fa-handshake',
                'subtitle' => 'High-Integrity Acquisitions, Sales & Corporate Lettings',
                'short_description' => 'Strategic advisory and brokerage for acquisition, sale, and corporate letting of prime real estate assets nationwide.',
                'full_description' => 'Our Estate Agency department matches qualified buyers and institutional tenants with premium property owners. We conduct rigorous due diligence, title verification, commercial marketing, structured lease negotiations, and legal handing-over documentation.',
                'scope_of_work' => [
                    'Targeted Multi-Channel Marketing & Disposals',
                    'Institutional Land & Commercial Acquisition Advisory',
                    'Price & Lease Terms Negotiation',
                    'Title Verification & Legal Documentation Coordination',
                    'Comprehensive Schedule of Condition & Inventory Handing-Over',
                ],
                'asset_classes' => [
                    'Prime Commercial Plots & Development Sites',
                    'Luxury Residential Villas & Penthouses',
                    'Industrial Warehouses & Logistics Hubs',
                    'Retail Spaces & Mixed-Use Plazas',
                ],
                'featured_image' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=1200&q=80',
                'sort_order' => 3,
            ],
            [
                'title' => 'Investment Appraisal & Project Management',
                'slug' => 'investment-appraisal',
                'icon' => 'fa-chart-pie',
                'subtitle' => 'Feasibility Studies for ₦5B+ Cumulative Capital Projects',
                'short_description' => 'Rigorous viability analyses, financial modeling, sensitivity testing, and development project management to guarantee optimal ROI.',
                'full_description' => 'We assist banks, private equity firms, consortiums, and institutional investors in evaluating real estate developments. From initial market demand analysis and cash flow forecasting to full project management oversight, we protect capital and minimize construction delays and wastages.',
                'scope_of_work' => [
                    'Comprehensive Feasibility & Viability Studies',
                    'Market Demand & Supply Dynamics Analysis',
                    'Cash Flow Forecasts, Projected P&L & Balance Sheet Modeling',
                    'Sensitivity Testing, Risk Analysis & Mitigation Strategies',
                    'Full Life-Cycle Project Management Oversight',
                    'Consortium Financing & Site/Services Scheme Advisory',
                ],
                'asset_classes' => [
                    'Residential Estate Masterplans & Gated Communities',
                    'Hospitality & Hotel Developments',
                    'Agro-Allied Processing Complexes',
                    'Commercial Retail & Logistics Parks',
                ],
                'featured_image' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=1200&q=80',
                'sort_order' => 4,
            ],
            [
                'title' => 'Revenue Strategy & Corporate Turnaround',
                'slug' => 'revenue-strategy',
                'icon' => 'fa-arrows-rotate',
                'subtitle' => 'Maximizing Yields & Distressed Asset Restructuring',
                'short_description' => 'Proprietary restructuring methodologies for underperforming real estate portfolios, mid-market companies, and government entities.',
                'full_description' => 'We diagnose underperforming real estate portfolios and implement strategic restructuring plans that accelerate revenue growth, resolve distressed debt encumbrances, and enhance asset liquidation or refinancing value.',
                'scope_of_work' => [
                    'Revenue Engine & Portfolio Yield Assessment',
                    'Distressed Asset Repositioning & Restructuring',
                    'Private Equity Due Diligence & Upside Evaluation',
                    'Alternative Real Estate Finance Models (Sale-Leaseback, Equity Release)',
                ],
                'asset_classes' => [
                    'Underperforming Corporate Portfolios',
                    'Privatization Candidate Assets',
                    'Bank Collateral Recovery Portfolios',
                ],
                'featured_image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1200&q=80',
                'sort_order' => 5,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::updateOrCreate(['slug' => $serviceData['slug']], $serviceData);
        }

        // 3. Team members are managed exclusively by the user via the Admin CMS.
        // Seeder does NOT create or overwrite team profiles.

        // 4. Seed Real Properties Only
        $properties = [
            [
                'title' => 'Prime Commercial Plot (8,464 sqm) — Central Area (Cadastral Zone A00)',
                'slug' => 'prime-commercial-plot-central-area-8464sqm',
                'reference_no' => 'NOA-CA8464',
                'property_type' => 'Commercial',
                'listing_type' => 'for_sale',
                'price' => 12000000000.00,
                'price_prefix' => '₦',
                'price_unit' => 'total',
                'location_address' => 'Central Area, Cadastral Zone A00 (File No: MISC 152027)',
                'location_city' => 'Abuja',
                'location_state' => 'Abuja FCT',
                'bedrooms' => null,
                'bathrooms' => null,
                'land_area' => '8,464.22 sqm',
                'building_area' => 'Permitted High-Rise Commercial / Mixed-Use Development',
                'title_document' => 'FCDA / AGIS Allocation & Survey Plan (File No: MISC 152027)',
                'description' => "A prime commercial parcel measuring 8,464.22 square meters strategically situated in the prestigious Central Area (Cadastral Zone A00), Abuja FCT.\n\nKey Cadastral & Survey Particulars:\n• File No: MISC 152027\n• Cadastral Zone: A00 (Central Area, Abuja)\n• Exact Land Area: 8,464.22 m² (92.00m x 92.00m regular square layout, Scale 1:2500)\n• Beacon Coordinates: UTM Zone 32N (N. 1,000,528.67, E. 333,135.59)\n• Cadastral Map: 1:5000 (Sheet 332/999)\n• Survey Certification: Surveyed by FCDA Land Surveyors, prepared and certified by Abuja Geographic Information Systems (AGIS)\n\nDevelopment Potential:\nThe property provides a 92m x 92m regular rectangular configuration ideal for Grade-A corporate towers, luxury mixed-use retail/office hubs, financial institution headquarters, or international organizational complexes with immediate dual-access infrastructure.",
                'features' => [
                    '8,464.22 sqm Regular Plot (92m x 92m)',
                    'Cadastral Zone A00 (Central Area)',
                    'AGIS Certified Survey Plan',
                    'File No. MISC 152027',
                    'Permitted High-Rise Commercial Zoning',
                    'UTM Zone 32N Coordinates (N 1,000,528.67, E 333,135.59)',
                    'Dual Access Road Infrastructure',
                    'Immediate Development Readiness'
                ],
                'featured_image' => '/images/properties/central-area-commercial-plot-survey.png',
                'status' => 'available',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Prime Residential Development Land (2,865.80 sqm) — Plot 366 Jahi District (Zone B08)',
                'slug' => 'prime-residential-plot-366-jahi-district-2900sqm',
                'reference_no' => 'NOA-JAH366',
                'property_type' => 'Residential',
                'listing_type' => 'for_sale',
                'price' => 950000000.00,
                'price_prefix' => '₦',
                'price_unit' => 'total',
                'location_address' => 'Plot 366, Cadastral Zone B08, Jahi District',
                'location_city' => 'Jahi, Abuja',
                'location_state' => 'Abuja FCT',
                'bedrooms' => null,
                'bathrooms' => null,
                'land_area' => '2,865.80 sqm (approx. 2,900 sqm)',
                'building_area' => 'Approved for Luxury Residential Estate / Terraced Duplex Development',
                'title_document' => 'Certificate of Occupancy (C of O) & AGIS Survey (File No: MISC 53571)',
                'description' => "A prime residential development plot measuring 2,865.80 square meters (approximately 2,900 sqm) strategically located at Plot 366, Cadastral Zone B08 in the rapidly appreciating Jahi District, Abuja FCT.\n\nTITLE & LEGAL STATUS:\n• Certificate of Occupancy (C of O)\n• File No: MISC 53571\n• Cadastral Zone: B08 (Jahi District)\n• Plot Number: 366\n\nCADASTRAL & TECHNICAL METRICS:\n• Exact Surveyed Area: 2,865.80 m²\n• Scale: 1:1000\n• Full Beacon Reference: FCT B08 PB 1533 (Coordinates: N. 1,007,037.88, E. 328,737.56)\n• Coordinate System: UTM Zone 32N\n• Cadastral Map Sheet: 328/1005/NW4\n• Survey Authority: Surveyed by FCDA Land Surveyors, officially prepared and certified by Abuja Geographic Information Systems (AGIS)\n\nDEVELOPMENT HIGHLIGHTS:\n• Generous regular-dimensioned parcel ideal for a luxury private mini-estate, contemporary multi-unit semi-detached/terraced duplexes, or high-end bespoke private mansion.\n• Highly accessible location with fast arterial connectivity to Katampe, Mabushi, Wuse II, and Central Business District.\n• Fast developing neighborhood with ongoing infrastructure and strong capital appreciation.",
                'features' => [
                    'Certificate of Occupancy (C of O)',
                    '2,865.80 sqm Surveyed Land Area',
                    'Cadastral Zone B08 (Plot 366 Jahi)',
                    'AGIS Certified Survey Plan (File MISC 53571)',
                    'UTM Zone 32N Beacon Coordinates (PB 1533)',
                    'Ideal for Luxury Terraces or Mini-Estate',
                    'Fast-Appreciating High-Demand Corridor',
                    'Direct & Unencumbered Allocation'
                ],
                'featured_image' => '/images/properties/jahi-district-plot-366-survey.jpg',
                'status' => 'available',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Executive Detached 6-Bedroom Duplex with BQ on 1,074 sqm — Plot 734 Maitama (Zone A06)',
                'slug' => 'executive-detached-6-bedroom-duplex-bq-1074sqm-maitama',
                'reference_no' => 'NOA-MAI734',
                'property_type' => 'Residential',
                'listing_type' => 'for_sale',
                'price' => 2200000000.00,
                'price_prefix' => '₦',
                'price_unit' => 'total',
                'location_address' => 'Plot 734, Cadastral Zone A06, Maitama District',
                'location_city' => 'Maitama, Abuja',
                'location_state' => 'Abuja FCT',
                'bedrooms' => 6,
                'bathrooms' => 7,
                'land_area' => '1,074.04 sqm',
                'building_area' => 'Fully Detached 6-Bedroom Luxury Mansion + 2-Room Staff Quarters (BQ)',
                'title_document' => 'Certificate of Occupancy (C of O) & AGIS Survey Plan (File No: MISC 56180)',
                'description' => "An executive fully detached 6-bedroom contemporary duplex mansion with detached Boys Quarters (BQ) seated on a generous private compound measuring 1,074.04 square meters at Plot 734, Cadastral Zone A06 in the high-brow diplomatic enclave of Maitama, Abuja.\n\nTITLE & DOCUMENTATION:\n• Certificate of Occupancy (C of O)\n• File No: MISC 56180\n• Cadastral Zone: A06 (Maitama District)\n• Plot Number: 734\n\nCADASTRAL & METRIC HIGHLIGHTS:\n• Land Size: 1,074.04 m²\n• Scale: 1:1000\n• Full Beacon Reference: FCT A06 PB 2603 (Coordinates: N. 1,007,110.10, E. 333,298.63)\n• Coordinate System: UTM Zone 32N\n• Cadastral Map Sheet: 332/1005/NE3\n• Survey Authority: Surveyed by Geodata Ltd, prepared and certified by Abuja Geographic Information Systems (AGIS)\n\nESTATE FEATURES & SPECIFICATIONS:\n• 6 Generous En-Suite Bedrooms with Luxury Bathrooms & Walk-In Closets\n• Expansive Ante-Room, Main Formal Living Room, Family Lounge & Private Penthouse Terrace\n• Fully Fitted Chef's Kitchen with Pantry & Store\n• Self-Contained 2-Room Service Staff Quarters (BQ)\n• Ample Paved Parking for 10+ Vehicles\n• High Security Perimeter Wall with Electric Fence & Gated Gatehouse\n• Serene High-Profile Neighborhood with Excellent Diplomatic & Commercial Accessibility.",
                'features' => [
                    'Certificate of Occupancy (C of O)',
                    '1,074.04 sqm Land Area',
                    '6 En-Suite Luxury Bedrooms',
                    'Self-Contained Staff Quarters (BQ)',
                    'Cadastral Zone A06 (Plot 734 Maitama)',
                    'AGIS Certified Survey Plan (File MISC 56180)',
                    'UTM Zone 32N Coordinates (PB 2603)',
                    'Ample Parking for 10+ Vehicles',
                    'Diplomatic Enclave Location'
                ],
                'featured_image' => '/images/properties/maitama-6bed-duplex-exterior.jpg',
                'gallery_images' => [
                    '/images/properties/maitama-plot-734-survey-plan.jpg'
                ],
                'status' => 'available',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'PRICE SLASHED FOR IMMEDIATE PURCHASE: 3-Floor Office Complex (36 Suites), Zone 1 Wuse',
                'slug' => 'price-slashed-3-floor-office-complex-36-suites-zone-1-wuse',
                'reference_no' => 'NOA-WUS-001',
                'property_type' => 'Commercial',
                'listing_type' => 'for_sale',
                'price' => 3200000000.00,
                'price_prefix' => '₦',
                'price_unit' => 'net',
                'location_address' => 'Zone 1, Wuse District',
                'location_city' => 'Wuse Zone 1, Abuja',
                'location_state' => 'Abuja FCT',
                'bedrooms' => null,
                'bathrooms' => 36,
                'land_area' => 'Ample Commercial Grounds',
                'building_area' => '3-Floor Complex (36 Suites)',
                'title_document' => 'Certificate of Occupancy (C of O)',
                'description' => "PRICE SLASHED FOR IMMEDIATE PURCHASE.\n\nAn executive commercial office complex developed on 3 floors comprising 36 self-contained suites located in the prestigious Zone 1, Wuse, Abuja.\n\nTITLE: Certificate of Occupancy (C of O).\n\nFURTHER DESCRIPTION & HIGHLIGHTS:\n• Good ambiance with serene commercial prestige\n• Highly accessible location with seamless dual-carriage arterial road linkages\n• High profile and secure neighborhood\n• Generously paved grounds on interlocking stones\n• Dedicated high-capacity transformer guaranteeing uninterrupted power\n• 36 spacious office suites suited for corporate headquarters, diplomatic missions, financial institutions, or premier rental yield.",
                'features' => [
                    'Certificate of Occupancy (C of O)',
                    '3-Floor Commercial Complex (36 Suites)',
                    'Dedicated High-Capacity Transformer',
                    'Well Paved on Interlocking Stones',
                    'Highly Accessible Prime Corridor',
                    'High Profile Neighborhood',
                    'Good Ambiance',
                    'Price Slashed for Immediate Purchase'
                ],
                'featured_image' => '/images/properties/wuse-zone1-office-complex.webp',
                'gallery_images' => [
                    '/images/properties/wuse-zone1-office-complex.webp'
                ],
                'status' => 'available',
                'is_featured' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($properties as $propData) {
            Property::updateOrCreate(['reference_no' => $propData['reference_no']], $propData);
        }
    }
}
