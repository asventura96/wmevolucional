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
        Schema::create('candidate_contacts', function (Blueprint $table) {
            $table->id(); //

            // A LIGAÇÃO:
            // Usando candidate_id (integer)
            $table->foreignId('candidate_id')
                ->constrained('candidates') // Aponta para a tabela 'candidates'
                ->onDelete('cascade');

            $table->string('mobile', 15)->nullable(); //
            $table->boolean('is_whatsapp')->default(false); //
            $table->string('email')->nullable(); //
            $table->string('instagram')->nullable(); //
            $table->string('linkedin')->nullable(); //
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_contacts');
    }
};
