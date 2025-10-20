<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Credenciamento</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">

</head>
<body>

    <form class="form-container" action="#" method="POST">

        @csrf

        <h1>Formulário de Credenciamento</h1>

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

        <hr>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Enviar Cadastro</button>
        </div>

    </form>

</body>
</html>