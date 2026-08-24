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
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('designation'); // Principal Partner, Senior Partner, Branch Manager, etc.
            $table->string('cadre')->nullable(); // Fellow (F231), Associate (A2281), Probationer, Affiliate
            $table->string('registration_no')->nullable(); // e.g. F231, A2281, A2494
            $table->string('qualifications')->nullable(); // B.Sc (Est. Man), FNIVS, RSV, etc.
            $table->string('experience_years')->nullable(); // e.g. 40+ Years, 14 Years
            $table->string('branch_location')->nullable(); // Kaduna Head Office, Abuja, Abia, USA Link
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('bio');
            $table->json('education')->nullable(); // School, Degree, Year
            $table->json('career_history')->nullable(); // Past roles & institutions
            $table->json('key_projects')->nullable(); // Notable valuation & management accomplishments
            $table->json('special_skills')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('is_partner')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
