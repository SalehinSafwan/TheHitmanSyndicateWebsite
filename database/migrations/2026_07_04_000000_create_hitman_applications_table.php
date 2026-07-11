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
        Schema::create('hitman_applications', function (Blueprint $table) {
            $table->id();
            $table->string('codename')->unique();
            $table->string('specialty');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('referral_codename')->nullable();
            $table->string('currency_answer')->nullable();
            $table->string('hotel_rule_answer')->nullable();
            $table->string('best_weapon_answer')->nullable();
            $table->text('motivation')->nullable();
            $table->string('status')->default('pending');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hitman_applications');
    }
};