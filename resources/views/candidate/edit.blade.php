@extends('layouts.app')

@section('title', 'Editar Cadastro')

@section('content')

    <form class="form-container" action="{{ route('candidate.update', ['candidate' => $candidate->id]) }}" method="POST">
        @csrf
        @method('PUT') {{-- Informa ao Laravel que é uma atualização --}}

        <h1>Editar Cadastro</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
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

        <p>Atualize suas informações abaixo.</p>

        <h2>Dados Pessoais</h2>
        <div class="form-group">
            <label class="form-label" for="name">Nome Civil:</label>
            {{-- O helper old() pega o valor antigo (se deu erro) ou o valor do $candidate --}}
            <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $candidate->name) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="cpf">CPF:</label>
            {{-- Mostra o CPF, mas desabilitado (não pode mudar) --}}
            <input class="form-control" type="text" id="cpf" name="cpf" value="{{ $candidate->cpf }}" required readonly disabled> 
            {{-- Adicionamos um campo oculto para enviar o CPF mesmo assim --}}
            <input type="hidden" name="cpf" value="{{ $candidate->cpf }}">
        </div>

        <div class="form-group">
            <label class="form-label" for="birth_date">Data de Nascimento:</label>
            <input class="form-control" type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $candidate->birth_date?->format('Y-m-d')) }}" required>
        </div>

        {{-- Campos Dropdown - Dados Pessoais --}}
        <div class="form-group">
            <label class="form-label" for="zodiac_sign_id">Signo:</label>
            <select class="form-control" id="zodiac_sign_id" name="zodiac_sign_id" required>
                <option value="">Selecione...</option>
                {{-- Loop para preencher as opções --}}
                @foreach($zodiacSigns as $sign)
                    <option value="{{ $sign->id }}" 
                            {{-- A MÁGICA: Marca como 'selected' se for o valor atual do candidato --}}
                            @if(old('zodiac_sign_id', $candidate->zodiac_sign_id) == $sign->id) selected @endif>
                        {{ $sign->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label" for="religion_id">Religião:</label>
            <select class="form-control" id="religion_id" name="religion_id">
                <option value="">Selecione...</option>
                @foreach($religions as $religion)
                    <option value="{{ $religion->id }}" 
                            @if(old('religion_id', $candidate->religion_id) == $religion->id) selected @endif>
                        {{ $religion->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label" for="marital_status_id">Estado Civil:</label>
            <select class="form-control" id="marital_status_id" name="marital_status_id">
                <option value="">Selecione...</option>
                @foreach($maritalStatuses as $status)
                    <option value="{{ $status->id }}" 
                            @if(old('marital_status_id', $candidate->marital_status_id) == $status->id) selected @endif>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label" for="birthplace_id">Naturalidade (Cidade / Estado):</label>
            <select class="form-control" id="birthplace_id" name="birthplace_id">
                <option value="">Selecione...</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" 
                            @if(old('birthplace_id', $candidate->birthplace_id) == $city->id) selected @endif>
                        {{ $city->name }} {{-- TODO: Adicionar o Estado aqui --}}
                    </option>
                @endforeach
            </select>
        </div>

        <h2>Filiação</h2>
        <div class="form-group">
            <label class="form-label" for="mother_name">Nome da Mãe:</label>
            <input class="form-control" type="text" id="mother_name" name="mother_name" value="{{ old('mother_name', $candidate->mother_name) }}">
        </div>
        <div class="form-group">
            <label class="form-label" for="mother_profession_id">Profissão da Mãe:</label>
            <select class="form-control" id="mother_profession_id" name="mother_profession_id">
                <option value="">Selecione...</option>
                {{-- Reutiliza a variável $professions --}}
                @foreach($professions as $profession)
                    <option value="{{ $profession->id }}" 
                            @if(old('mother_profession_id', $candidate->mother_profession_id) == $profession->id) selected @endif>
                        {{ $profession->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label" for="father_name">Nome do Pai:</label>
            <input class="form-control" type="text" id="father_name" name="father_name" value="{{ old('father_name', $candidate->father_name) }}">
        </div>
        <div class="form-group">
            <label class="form-label" for="father_profession_id">Profissão do Pai:</label>
            <select class="form-control" id="father_profession_id" name="father_profession_id">
                <option value="">Selecione...</option>
                {{-- Reutiliza a variável $professions --}}
                @foreach($professions as $profession)
                    <option value="{{ $profession->id }}" 
                            @if(old('father_profession_id', $candidate->father_profession_id) == $profession->id) selected @endif>
                        {{ $profession->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <h2>Família</h2>
        <div class="form-group">
            <label class="form-label">Irmãos?</label>
            {{-- Usamos @checked para marcar o radio button correto --}}
            <input type="radio" id="has_siblings_no" name="has_siblings" value="0" @checked(old('has_siblings', $candidate->has_siblings) == 0)> <label for="has_siblings_no">Não</label>
            <input type="radio" id="has_siblings_yes" name="has_siblings" value="1" @checked(old('has_siblings', $candidate->has_siblings) == 1)> <label for="has_siblings_yes">Sim</label>
        </div>
        <div class="form-group">
            <label class="form-label" for="siblings_count">Quantos?</label>
            <input class="form-control" type="number" id="siblings_count" name="siblings_count" value="{{ old('siblings_count', $candidate->siblings_count) }}" min="0">
        </div>

        <div class="form-group">
            <label class="form-label">Filhos?</label>
            <input type="radio" id="has_children_no" name="has_children" value="0" @checked(old('has_children', $candidate->has_children) == 0)> <label for="has_children_no">Não</label>
            <input type="radio" id="has_children_yes" name="has_children" value="1" @checked(old('has_children', $candidate->has_children) == 1)> <label for="has_children_yes">Sim</label>
        </div>
        <div class="form-group">
            <label class="form-label" for="children_count">Quantos?</label>
            <input class="form-control" type="number" id="children_count" name="children_count" value="{{ old('children_count', $candidate->children_count) }}" min="0">
        </div>
        <div class="form-group">
            <label class="form-label" for="children_age">Idades?</label>
            <input class="form-control" type="text" id="children_age" name="children_age" value="{{ old('children_age', $candidate->children_age) }}" placeholder="Ex: 3, 5 e 7">
        </div>

        <div class="form-group">
            <label class="form-label" for="spouse_name">Nome do(a) Cônjuge:</label>
            <input class="form-control" type="text" id="spouse_name" name="spouse_name" value="{{ old('spouse_name', $candidate->spouse_name) }}">
        </div>
        <div class="form-group">
            <label class="form-label" for="spouse_profession_id">Profissão do(a) Cônjuge:</label>
            <select class="form-control" id="spouse_profession_id" name="spouse_profession_id">
                <option value="">Selecione...</option>
                {{-- Reutiliza a variável $professions --}}
                @foreach($professions as $profession)
                    <option value="{{ $profession->id }}" 
                            @if(old('spouse_profession_id', $candidate->spouse_profession_id) == $profession->id) selected @endif>
                        {{ $profession->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label" for="notes">Observações:</label>
            <textarea class="form-control" id="notes" name="notes" rows="4">{{ old('notes', $candidate->notes) }}</textarea> {{-- Para textarea, o valor vai dentro da tag --}}
        </div>

        <hr>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </div>

    </form>

@endsection