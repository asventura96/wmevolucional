<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\MaritalStatus;
use App\Models\Profession;
use App\Models\Religion;
use App\Models\State;
use App\Models\StateCity;
use App\Models\ZodiacSign;
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

    /**
     * Salva o novo candidato no banco de dados.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. VALIDAÇÃO:
        // Se a validação falhar, o Laravel automaticamente
        // redireciona o usuário de volta e mostra os erros.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:candidates,cpf',
            'birth_date' => 'required|date',
            'zodiac_sign_id' => 'required|integer|exists:zodiac_signs,id',
            'religion_id' => 'nullable|integer|exists:religions,id',
            'marital_status_id' => 'nullable|integer|exists:marital_statuses,id',
        ]);

        // 2. CRIAÇÃO:
        // (Isso só funciona por causa do $guarded = [] que você adicionou)
        Candidate::create($validatedData);

        // 3. REDIRECIONAMENTO:
        // Volta para a página de cadastro com uma mensagem de sucesso
        return redirect()->route('candidate.register.create')
                        ->with('success', 'Cadastro realizado com sucesso!');
    }
}
