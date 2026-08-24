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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('icon')->nullable(); // e.g. fa-chart-line, fa-building, fa-file-contract
            $table->string('subtitle')->nullable();
            $table->text('short_description');
            $table->longText('full_description');
            $table->json('scope_of_work')->nullable(); // detailed bullet points from PDF
            $table->json('asset_classes')->nullable(); // e.g. Land & Buildings, Plants & Machinery, Farmlands, Oil Rigs
            $table->string('featured_image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
