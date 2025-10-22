<?php

use App\Http\Controllers\CandidateRegistrationController;
use Illuminate\Support\Facades\Route;

// ROTA PRINCIPAL: Mostra a tela de verificação (CPF + Data Nasc)
Route::get('/', [CandidateRegistrationController::class, 'showCheckForm'])
     ->name('candidate.check.form'); // Nome da rota para mostrar o form

// ROTA PARA RECEBER A VERIFICAÇÃO (Vamos criar o método checkCandidate daqui a pouco)
Route::post('/check', [CandidateRegistrationController::class, 'checkCandidate'])
     ->name('candidate.check'); 

// ROTAS DO FORMULÁRIO DE CADASTRO (Agora em /register)
Route::get('/register', [CandidateRegistrationController::class, 'create'])
     ->name('candidate.register.create'); 
Route::post('/register', [CandidateRegistrationController::class, 'store'])
     ->name('candidate.register.store');

// ROTA PARA MOSTRAR O FORMULÁRIO DE EDIÇÃO
Route::get('/candidate/{candidate}/edit', [CandidateRegistrationController::class, 'edit'])
     ->name('candidate.edit'); // Nome da rota para mostrar o form de edição
     // ->middleware('auth'); // TODO: Adicionar segurança depois (login)

// ROTA PARA RECEBER A ATUALIZAÇÃO (UPDATE)
Route::put('/candidate/{candidate}', [CandidateRegistrationController::class, 'update'])
     ->name('candidate.update'); // Nome da rota para salvar a edição
     // ->middleware('auth'); // TODO: Adicionar segurança depois