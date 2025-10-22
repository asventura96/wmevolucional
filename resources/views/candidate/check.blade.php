@extends('layouts.app')

@section('title', 'Verificar Cadastro')

@section('content')

    <form class="form-container" action="{{ route('candidate.check') }}" method="POST"> 
        @csrf

        <h1>Verificar Cadastro</h1>
        <p>Por favor, informe seu CPF e Data de Nascimento para verificar se você já possui cadastro.</p>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
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

        <div class="form-group">
            <label class="form-label" for="cpf">CPF:</label>
            <input class="form-control" type="text" id="cpf" name="cpf" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="birth_date">Data de Nascimento:</label>
            <input class="form-control" type="date" id="birth_date" name="birth_date" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Verificar</button>
        </div>

    </form>

@endsection