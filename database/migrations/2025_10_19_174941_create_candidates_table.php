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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id(); //
            $table->string('cpf', 11)->unique(); //
            $table->string('name'); //
            $table->date('birth_date'); //

            // Chaves Estrangeiras (Lookups)
            $table->foreignId('zodiac_sign_id')->constrained('zodiac_signs'); //
            $table->foreignId('religion_id')->nullable()->constrained('religions'); //
            $table->foreignId('marital_status_id')->nullable()->constrained('marital_status'); //
            $table->foreignId('birthplace_id')->nullable()->constrained('state_cities'); //

            // Pai
            $table->string('father_name')->nullable(); //
            $table->foreignId('father_profession_id')->nullable()->constrained('professions'); //

            // Mãe
            $table->string('mother_name')->nullable(); //
            $table->foreignId('mother_profession_id')->nullable()->constrained('professions'); //

            // Cônjuge
            $table->string('spouse_name')->nullable(); //
            $table->foreignId('spouse_profession_id')->nullable()->constrained('professions'); //

            // Irmãos
            $table->boolean('has_siblings')->default(false); //
            $table->integer('siblings_count')->nullable(); //

            // Filhos
            $table->boolean('has_children')->default(false); //
            $table->integer('children_count')->nullable(); //
            $table->string('children_age')->nullable(); // (Corrigi o typo 'hildren_age')

            // Outros
            $table->text('notes')->nullable(); //
            $table->boolean('idle')->default(false); //
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
