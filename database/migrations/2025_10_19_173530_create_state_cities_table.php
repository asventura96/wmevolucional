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
        Schema::create('state_cities', function (Blueprint $table) {
            $table->id();

            // A LIGAÇÃO:
            $table->foreignId('state_id')
                ->constrained('states')
                ->onDelete('cascade');

            $table->string('name');
            $table->text('notes')->nullable();
            $table->boolean('idle')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_cities');
    }
};
