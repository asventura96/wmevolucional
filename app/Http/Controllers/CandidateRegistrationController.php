<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\MaritalStatus;
use App\Models\Profession;
use App\Models\Religion;
use App\Models\State;
use App\Models\StateCity;
use App\Models\ZodiacSign;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CandidateRegistrationController extends Controller
{
    // <-- COLE A FUNÇÃO A PARTIR DAQUI

    /**
     * Mostra o formulário de cadastro do candidato.
     */
    public function create()
    {
        // 1. Busca todos os registros das tabelas de apoio
        $professions = Profession::orderBy('name')->get(); // <--- JÁ ESTAVA AQUI
        $religions = Religion::orderBy('name')->get(); // <--- JÁ ESTAVA AQUI
        $maritalStatuses = MaritalStatus::orderBy('name')->get(); // <--- JÁ ESTAVA AQUI
        $zodiacSigns = ZodiacSign::all(); // <--- JÁ ESTAVA AQUI
        $states = State::orderBy('name')->get(); // <--- JÁ ESTAVA AQUI

        // --- NOVOS DADOS ---
        $cities = StateCity::orderBy('name')->get(); 
        // Nota: Idealmente, carregaríamos as cidades dinamicamente
        //       baseado no estado, mas para começar, vamos carregar todas.

        // 2. Envia essas variáveis para a view 'candidate.register'
        return view('candidate.register', [
            'professions' => $professions,
            'religions' => $religions,
            'maritalStatuses' => $maritalStatuses,
            'zodiacSigns' => $zodiacSigns,
            'states' => $states,
            'cities' => $cities, // <-- NOVO
        ]);
    }

    /**
     * Salva o novo candidato no banco de dados.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. VALIDAÇÃO COMPLETA:
        $validatedData = $request->validate([
            // Dados Pessoais
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:candidates,cpf',
            'birth_date' => 'required|date',
            'zodiac_sign_id' => 'required|integer|exists:zodiac_signs,id',
            'religion_id' => 'nullable|integer|exists:religions,id',
            'marital_status_id' => 'nullable|integer|exists:marital_statuses,id',
            'birthplace_id' => 'nullable|integer|exists:state_cities,id',

            // Login
            'email_principal' => 'required|email|max:255|unique:candidates,email_principal',
            'senha_hash' => 'required|string|min:8|confirmed', // 'confirmed' checa o 'senha_hash_confirmation'

            // Filiação
            'mother_name' => 'nullable|string|max:255',
            'mother_profession_id' => 'nullable|integer|exists:professions,id',
            'father_name' => 'nullable|string|max:255',
            'father_profession_id' => 'nullable|integer|exists:professions,id',

            // Família
            'has_siblings' => 'required|boolean',
            'siblings_count' => 'nullable|integer|min:0',
            'has_children' => 'required|boolean',
            'children_count' => 'nullable|integer|min:0',
            'children_age' => 'nullable|string|max:255',
            'spouse_name' => 'nullable|string|max:255',
            'spouse_profession_id' => 'nullable|integer|exists:professions,id',

            // Outros
            'notes' => 'nullable|string',

            // LGPD (Vamos adicionar um checkbox para isso depois)
            // 'data_consentimento_lgpd' => 'required' 
        ]);

        // 2. PREPARAR OS DADOS

        // Criptografar a senha antes de salvar
        $validatedData['senha_hash'] = Hash::make($request->senha_hash);

        // Adicionar o timestamp da LGPD (provisório)
        $validatedData['data_consentimento_lgpd'] = now();

        // 3. CRIAÇÃO:
        Candidate::create($validatedData);

        // 4. REDIRECIONAMENTO:
        return redirect()->route('candidate.register.create')
                        ->with('success', 'Cadastro realizado com sucesso!');
    }
}
