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
        Schema::create('candidate_addresses', function (Blueprint $table) {
            $table->id(); //

            // A LIGAÇÃO:
            $table->foreignId('candidate_id')
                ->constrained('candidates') // Aponta para a tabela 'candidates'
                ->onDelete('cascade');

            $table->string('address'); //
            $table->string('number'); // (Mudei para string, que é mais seguro para '10B', 'S/N', etc.)
            $table->string('complement')->nullable(); //
            $table->string('neighborhood'); //
            $table->string('zip_code', 8)->nullable(); //

            // Ligação com a tabela 'state_cities'
            $table->foreignId('city_id')->nullable()->constrained('state_cities'); //

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_addresses');
    }
};
