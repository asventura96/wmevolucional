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
        Schema::create('candidate_documents', function (Blueprint $table) {
            $table->id(); //

            // A LIGAÇÃO:
            // Vamos usar candidate_id (integer) para ligar, 
            // em vez de candidate (varchar), pelo motivo que eu te disse.
            $table->foreignId('candidate_id')
                ->constrained('candidates') // Aponta para a tabela 'candidates'
                ->onDelete('cascade');

            $table->string('id_number')->nullable(); //
            $table->date('id_issue_date')->nullable(); // (Mudei o nome para 'id_issue_date' para ser mais claro)
            $table->string('id_issuer')->nullable(); //

            // Ligação com a tabela 'states'
            $table->foreignId('id_issue_state_id')->nullable()->constrained('states'); //

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_documents');
    }
};
