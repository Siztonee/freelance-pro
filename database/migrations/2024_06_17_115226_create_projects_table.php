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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name');
            $table->text('description');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('pay')->nullable();
            $table->boolean('is_negotiable')->default(0);
            $table->integer('deadline');
            $table->text('requirement_skills');
            $table->boolean('is_banned')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
