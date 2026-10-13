<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_representative_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('job_title')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('photo_id_front_path')->nullable()->comment('Private storage path to front of ID');
            $table->string('photo_id_back_path')->nullable()->comment('Private storage path to back of ID');
            $table->string('signature_path')->nullable()->comment('Private storage path to electronic signature');
            $table->timestamp('terms_accepted_at')->nullable();
            $table->string('terms_version')->nullable()->default('1.0');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_representative_profiles');
    }
};
