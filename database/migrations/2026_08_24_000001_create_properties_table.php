<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('reference_no')->unique()->nullable();
            $table->string('property_type'); // Commercial, Residential, Industrial, Agricultural, Land, Hospitality, Special Purpose
            $table->string('listing_type'); // for_sale, for_lease, joint_venture, valuation_record
            $table->decimal('price', 15, 2)->nullable();
            $table->string('price_prefix')->default('₦');
            $table->string('price_unit')->nullable(); // per annum, total, negotiable, POA
            $table->string('location_address')->nullable();
            $table->string('location_city');
            $table->string('location_state');
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->string('land_area')->nullable(); // e.g. 2,500 sqm, 5 Hectares
            $table->string('building_area')->nullable();
            $table->text('description');
            $table->json('features')->nullable(); // Array of bullet points/features
            $table->string('featured_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('status')->default('available'); // available, under_offer, sold, leased, valuation_closed
            $table->decimal('sold_price', 15, 2)->nullable();
            $table->date('sold_date')->nullable();
            $table->string('client_name')->nullable(); // e.g. AMCON, NDDC, Private Investor
            $table->string('transaction_summary')->nullable(); // brief note for closed deals portfolio
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
