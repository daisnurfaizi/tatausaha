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
        Schema::create('aplications', function (Blueprint $table) {
            $table->id();
            $table->string('login_logo')->nullable();
            $table->string('sidebar_logo_small')->nullable();
            $table->string('sidebar_logo')->nullable();
            $table->string('title')->nullable();
            $table->string('owner')->nullable();
            $table->string('footer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aplications');
    }
};
