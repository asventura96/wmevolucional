<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidateAddress;
use App\Models\CandidateContact;
use App\Models\CandidateDocument;
use App\Models\MaritalStatus;
use App\Models\Profession;
use App\Models\Religion;
use App\Models\State;
use App\Models\StateCity;
use App\Models\ZodiacSign;

use Illuminate\Support\Arr;
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
        // 1. VALIDAÇÃO COMPLETA (COM ENDEREÇO)
        $validatedData = $request->validate([
            // Dados Pessoais (candidates)
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:candidates,cpf',
            'birth_date' => 'required|date',
            'zodiac_sign_id' => 'required|integer|exists:zodiac_signs,id',
            'religion_id' => 'nullable|integer|exists:religions,id',
            'marital_status_id' => 'nullable|integer|exists:marital_statuses,id',
            'birthplace_id' => 'nullable|integer|exists:state_cities,id',
            'mother_name' => 'nullable|string|max:255',
            'mother_profession_id' => 'nullable|integer|exists:professions,id',
            'father_name' => 'nullable|string|max:255',
            'father_profession_id' => 'nullable|integer|exists:professions,id',
            'has_siblings' => 'required|boolean',
            'siblings_count' => 'nullable|integer|min:0',
            'has_children' => 'required|boolean',
            'children_count' => 'nullable|integer|min:0',
            'children_age' => 'nullable|string|max:255',
            'spouse_name' => 'nullable|string|max:255',
            'spouse_profession_id' => 'nullable|integer|exists:professions,id',
            'notes' => 'nullable|string',

            // Dados de Contato (candidate_contacts)
            'email' => 'nullable|email|max:255',
            'mobile' => 'nullable|string|max:15',
            'is_whatsapp' => 'nullable|boolean',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',

            // Dados de Documento (candidate_documents)
            'id_number' => 'nullable|string|max:255',
            'id_issuer' => 'nullable|string|max:255',
            'id_issue_state_id' => 'nullable|integer|exists:states,id',
            'id_issue_date' => 'nullable|date',

            // Dados de Endereço (candidate_address)
            'address' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:255',
            'complement' => 'nullable|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:8',
            'city_id' => 'nullable|integer|exists:state_cities,id',

            // Dados LGPD
            'lgpd_consent' => 'required|accepted',
        ]);

        // 2. PREPARAR OS DADOS

        $validatedData['data_consentimento_lgpd'] = now();
        $validatedData['is_whatsapp'] = $request->has('is_whatsapp') ? 1 : 0;

        // 3. SEPARAR OS DADOS PARA CADA TABELA

        $candidateData = Arr::only($validatedData, [
            'name', 'cpf', 'birth_date', 'zodiac_sign_id', 'religion_id', 
            'marital_status_id', 'birthplace_id', 'mother_name', 
            'mother_profession_id', 'father_name', 'father_profession_id', 
            'has_siblings', 'siblings_count', 'has_children', 'children_count', 
            'children_age', 'spouse_name', 'spouse_profession_id', 'notes',
            'data_consentimento_lgpd' 
        ]);

        $contactData = Arr::only($validatedData, [
            'email', 'mobile', 'is_whatsapp', 'instagram', 'linkedin'
        ]);

        $documentData = Arr::only($validatedData, [
            'id_number', 'id_issuer', 'id_issue_state_id', 'id_issue_date'
        ]);

        // NOVO: Pega os dados do Model 'CandidateAddress'
        $addressData = Arr::only($validatedData, [
            'address', 'number', 'complement', 'neighborhood', 'zip_code', 'city_id'
        ]);

        // 4. SALVAR

        $candidate = Candidate::create($candidateData);

        // Adiciona o ID do candidato aos dados relacionados
        $contactData['candidate_id'] = $candidate->id;
        $documentData['candidate_id'] = $candidate->id;
        $addressData['candidate_id'] = $candidate->id;

        // Cria os registros
        CandidateContact::create($contactData);
        CandidateDocument::create($documentData);
        CandidateAddress::create($addressData); // <-- NOVO

        // 5. REDIRECIONAMENTO:
        return redirect()->route('candidate.register.create')
                        ->with('success', 'Cadastro realizado com sucesso!');
    }

    /**
     * Mostra o formulário de verificação de CPF / Data Nasc.
     */
    public function showCheckForm()
    {
        // Carrega a view 'resources/views/candidate/check.blade.php'
        return view('candidate.check');
    }

    /**
     * Verifica se um candidato com o CPF e Data de Nascimento já existe.
     */
    public function checkCandidate(Request $request): RedirectResponse
    {
        // 1. Valida os dados que vieram do formulário de verificação
        $validated = $request->validate([
            'cpf' => 'required|string|max:14', // Max 14 para incluir máscara se houver
            'birth_date' => 'required|date',
        ]);

        // 2. Tenta encontrar o candidato no banco de dados
        $candidate = Candidate::where('cpf', $validated['cpf'])
                            ->where('birth_date', $validated['birth_date'])
                            ->first(); // Pega o primeiro resultado (ou null se não achar)

        // 3. Decide para onde redirecionar
        if ($candidate) {
            // -- CANDIDATO ENCONTRADO --
            // Redireciona para a rota de edição, passando o ID do candidato encontrado
            return redirect()->route('candidate.edit', ['candidate' => $candidate->id]);

        } else {
            // -- CANDIDATO NÃO ENCONTRADO --
            // Redireciona para a página do formulário de cadastro (/register)
            return redirect()->route('candidate.register.create');
        }
    }

    /**
     * Mostra o formulário para editar um candidato existente.
     */
    public function edit(Candidate $candidate) 
    {
        // 1. Carrega os dados relacionados junto com o candidato
        //    (Assumindo relacionamentos One-to-One chamados 'contact', 'document', 'address' no Model Candidate)
        //    Se os nomes forem diferentes, ajuste aqui.
        $candidate->loadMissing(['contact', 'document', 'address']); 

        // 2. Busca os dados para os dropdowns (igual fizemos no método create)
        $professions = Profession::orderBy('name')->get();
        $religions = Religion::orderBy('name')->get();
        $maritalStatuses = MaritalStatus::orderBy('name')->get();
        $zodiacSigns = ZodiacSign::all();
        $states = State::orderBy('name')->get();
        $cities = StateCity::orderBy('name')->get();

        // 3. Carrega a view de edição, passando tudo
        return view('candidate.edit', [
            'candidate' => $candidate,
            'professions' => $professions,
            'religions' => $religions,
            'maritalStatuses' => $maritalStatuses,
            'zodiacSigns' => $zodiacSigns,
            'states' => $states,
            'cities' => $cities,
        ]);
    }

    /**
     * Atualiza os dados do candidato no banco de dados.
     */
    public function update(Request $request, Candidate $candidate): RedirectResponse
    {
        // 1. VALIDAÇÃO (Similar ao 'store', mas ajustada para edição)
        //    (Vamos adicionar a validação completa depois)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'zodiac_sign_id' => 'required|integer|exists:zodiac_signs,id',
            'religion_id' => 'nullable|integer|exists:religions,id',
            'marital_status_id' => 'nullable|integer|exists:marital_statuses,id',
            'birthplace_id' => 'nullable|integer|exists:state_cities,id',
        ]);

        // 2. ATUALIZAÇÃO:
        //    O Laravel já nos deu o $candidate correto.
        //    O método update() salva apenas os campos validados.
        $candidate->update($validatedData);

        // TODO: Atualizar os dados relacionados (Contato, Documento, Endereço)

        // 3. REDIRECIONAMENTO:
        //    Volta para a página de EDIÇÃO com uma mensagem de sucesso
        return redirect()->route('candidate.edit', ['candidate' => $candidate->id])
                        ->with('success', 'Cadastro atualizado com sucesso!');
    }
}
