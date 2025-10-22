@extends('layouts.app')

@section('title', 'Editar Cadastro')

@section('content')

    <form class="form-container" action="#" method="POST"> {{-- TODO: Apontar para a rota de Update --}}
        @csrf
        @method('PUT') {{-- Informa ao Laravel que é uma atualização --}}

        <h1>Editar Cadastro</h1>
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

        {{-- TODO: Adicionar os outros campos (Signo, Religião, etc.) com os valores preenchidos --}}
        {{-- TODO: Adicionar os campos de Contato, Documento, Endereço com os valores preenchidos --}}

        <hr>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </div>

    </form>

@endsection