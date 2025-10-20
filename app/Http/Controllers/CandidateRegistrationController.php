<?php

namespace App\Http\Controllers;

use App\Models\MaritalStatus;
use App\Models\Profession;
use App\Models\Religion;
use App\Models\State;
use App\Models\StateCity;
use App\Models\ZodiacSign;
use Illuminate\Http\Request;

class CandidateRegistrationController extends Controller
{
    // <-- COLE A FUNÇÃO A PARTIR DAQUI

    /**
     * Mostra o formulário de cadastro do candidato.
     */
    public function create()
    {
        // 1. Busca todos os registros das tabelas de apoio
        $professions = Profession::orderBy('name')->get();
        $religions = Religion::orderBy('name')->get();
        $maritalStatuses = MaritalStatus::orderBy('name')->get();
        $zodiacSigns = ZodiacSign::all();
        $states = State::orderBy('name')->get();
        // $cities = StateCity::orderBy('name')->get(); // (Vamos deixar as cidades de fora por enquanto, para carregar dinamicamente depois)

        // 2. Envia essas variáveis para a view 'candidate.register'
        return view('candidate.register', [
            'professions' => $professions,
            'religions' => $religions,
            'maritalStatuses' => $maritalStatuses,
            'zodiacSigns' => $zodiacSigns,
            'states' => $states,
        ]);
    }
}
