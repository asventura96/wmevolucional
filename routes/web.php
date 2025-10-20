<?php

use App\Http\Controllers\CandidateRegistrationController; // 1. Importa o "cérebro"
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas Web
|--------------------------------------------------------------------------
|
| Esta é a rota principal que o candidato verá.
| Vamos fazer a home (/) já ser o formulário de cadastro.
|
*/

// 2. Aponta o endereço "/" para o método "create" dentro do "cérebro"
Route::get('/', [CandidateRegistrationController::class, 'create'])
     ->name('candidate.register.create'); // Dá um nome para esta rota