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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('general_inquiry'); // property_inquiry, valuation_request, facility_management, general_inquiry
            $table->foreignId('property_id')->nullable()->constrained('properties')->nullOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('organization')->nullable();
            $table->string('subject')->nullable();
            $table->string('service_category')->nullable(); // Property Valuation, Facility Management, Agency, Investment Appraisal
            $table->string('asset_type')->nullable(); // Land & Buildings, Plant & Machinery, Oil & Gas Assets, Agricultural, Commercial
            $table->string('asset_location')->nullable();
            $table->string('preferred_branch')->nullable(); // Kaduna HQ, Abuja Office, Abia Branch, USA Link
            $table->text('message');
            $table->string('status')->default('new'); // new, in_review, contacted, completed, archived
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
