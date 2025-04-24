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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('description');
            $table->string('pet_name')->nullable();;
            $table->string('sex')->nullable();;
            $table->string('age')->nullable();;
            $table->string('breed')->nullable();
            $table->string('contact_person')->nullable();;
            $table->string('contact_number')->nullable();;
            $table->text('pet_description')->nullable();;
            $table->decimal('reward', 10, 2)->nullable();
            $table->string('pet_photo')->nullable();
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
