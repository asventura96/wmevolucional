@extends('layouts.app')

@section('title', 'Formulário de Credenciamento')

@section('content')

    <form class="form-container" action="{{ route('candidate.register.store') }}" method="POST">
        @csrf

        <h1>Formulário de Credenciamento</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Opa!</strong> Algo deu errado:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2>Dados Pessoais</h2>
        <div class="form-group">
            <label class="form-label" for="name">Nome Civil:</label>
            <input class="form-control" type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="cpf">CPF:</label>
            <input class="form-control" type="text" id="cpf" name="cpf" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="birth_date">Data de Nascimento:</label>
            <input class="form-control" type="date" id="birth_date" name="birth_date" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="birthplace_id">Naturalidade (Cidade / Estado):</label>
            <select class="form-control" id="birthplace_id" name="birthplace_id">
                <option value="">Selecione...</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label" for="zodiac_sign_id">Signo:</label>
            <select class="form-control" id="zodiac_sign_id" name="zodiac_sign_id" required>
                <option value="">Selecione...</option>
                @foreach($zodiacSigns as $sign)
                    <option value="{{ $sign->id }}">{{ $sign->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label" for="religion_id">Religião:</label>
            <select class="form-control" id="religion_id" name="religion_id">
                <option value="">Selecione...</option>
                @foreach($religions as $religion)
                    <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label" for="marital_status_id">Estado Civil:</label>
            <select class="form-control" id="marital_status_id" name="marital_status_id">
                <option value="">Selecione...</option>
                @foreach($maritalStatuses as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>

        <h2>Filiação</h2>
        <div class="form-group">
            <label class="form-label" for="mother_name">Nome da Mãe:</label>
            <input class="form-control" type="text" id="mother_name" name="mother_name">
        </div>
        <div class="form-group">
            <label class="form-label" for="mother_profession_id">Profissão da Mãe:</label>
            <select class="form-control" id="mother_profession_id" name="mother_profession_id">
                <option value="">Selecione...</option>
                @foreach($professions as $profession)
                    <option value="{{ $profession->id }}">{{ $profession->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label" for="father_name">Nome do Pai:</label>
            <input class="form-control" type="text" id="father_name" name="father_name">
        </div>
        <div class="form-group">
            <label class="form-label" for="father_profession_id">Profissão do Pai:</label>
            <select class="form-control" id="father_profession_id" name="father_profession_id">
                <option value="">Selecione...</option>
                @foreach($professions as $profession)
                    <option value="{{ $profession->id }}">{{ $profession->name }}</option>
                @endforeach
            </select>
        </div>

        <h2>Família</h2>
        <div class="form-group">
            <label class="form-label">Irmãos?</label>
            <input type="radio" id="has_siblings_no" name="has_siblings" value="0" checked> <label for="has_siblings_no">Não</label>
            <input type="radio" id="has_siblings_yes" name="has_siblings" value="1"> <label for="has_siblings_yes">Sim</label>
        </div>
        <div class="form-group">
            <label class="form-label" for="siblings_count">Quantos?</label>
            <input class="form-control" type="number" id="siblings_count" name="siblings_count" min="0">
        </div>

        <div class="form-group">
            <label class="form-label">Filhos?</label>
            <input type="radio" id="has_children_no" name="has_children" value="0" checked> <label for="has_children_no">Não</label>
            <input type="radio" id="has_children_yes" name="has_children" value="1"> <label for="has_children_yes">Sim</label>
        </div>
        <div class="form-group">
            <label class="form-label" for="children_count">Quantos?</label>
            <input class="form-control" type="number" id="children_count" name="children_count" min="0">
        </div>
        <div class="form-group">
            <label class="form-label" for="children_age">Idades?</label>
            <input class="form-control" type="text" id="children_age" name="children_age" placeholder="Ex: 3, 5 e 7">
        </div>

        <div class="form-group">
            <label class="form-label" for="spouse_name">Nome do(a) Cônjuge:</label>
            <input class="form-control" type="text" id="spouse_name" name="spouse_name">
        </div>
        <div class="form-group">
            <label class="form-label" for="spouse_profession_id">Profissão do(a) Cônjuge:</label>
            <select class="form-control" id="spouse_profession_id" name="spouse_profession_id">
                <option value="">Selecione...</option>
                @foreach($professions as $profession)
                    <option value="{{ $profession->id }}">{{ $profession->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label" for="notes">Observações:</label>
            <textarea class="form-control" id="notes" name="notes" rows="4"></textarea>
        </div>

        <h2>Contatos</h2>
        <div class="form-group">
            <label class="form-label" for="email">E-mail Pessoal:</label>
            <input class="form-control" type="email" id="email" name="email">
        </div>

        <div class="form-group">
            <label class="form-label" for="mobile">Celular:</label>
            <input class="form-control" type="text" id="mobile" name="mobile">
        </div>

        <div class="form-group">
            <input type="checkbox" id="is_whatsapp" name="is_whatsapp" value="1"> 
            <label for="is_whatsapp">Este número é WhatsApp</label>
        </div>

        <div class="form-group">
            <label class="form-label" for="instagram">Instagram:</label>
            <input class="form-control" type="text" id="instagram" name="instagram" placeholder="@seu.usuario">
        </div>

        <div class="form-group">
            <label class="form-label" for="linkedin">LinkedIn:</label>
            <input class="form-control" type="text" id="linkedin" name="linkedin" placeholder="linkedin.com/in/seu-usuario">
        </div>

        <h2>Documentos</h2>
        <div class="form-group">
            <label class="form-label" for="id_number">Número da Identidade (RG):</label>
            <input class="form-control" type="text" id="id_number" name="id_number">
        </div>

        <div class="form-group">
            <label class="form-label" for="id_issuer">Órgão Emissor:</label>
            <input class="form-control" type="text" id="id_issuer" name="id_issuer">
        </div>

        <div class="form-group">
            <label class="form-label" for="id_issue_state_id">Estado Emissor (UF):</label>
            <select class="form-control" id="id_issue_state_id" name="id_issue_state_id">
                <option value="">Selecione o Estado...</option>
                @foreach($states as $state)
                    <option value="{{ $state->id }}">{{ $state->name }} ({{ $state->abbreviation }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label" for="id_issue_date">Data de Emissão:</label>
            <input class="form-control" type="date" id="id_issue_date" name="id_issue_date">
        </div>
        <hr>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Enviar Cadastro</button>
        </div>
    </form>

@endsection