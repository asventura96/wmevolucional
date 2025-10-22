<?php

namespace App\Filament\Resources\Candidates\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CandidateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('cpf')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                DatePicker::make('birth_date')
                    ->required(),
                Select::make('zodiac_sign_id')
                    ->relationship('zodiacSign', 'name') // Usa a função no Model Candidate
                    ->required(),

                Select::make('religion_id')
                    ->relationship('religion', 'name'), // Usa a função no Model Candidate

                Select::make('marital_status_id')
                    ->relationship('maritalStatus', 'name'), // Usa a função no Model Candidate

                Select::make('birthplace_id')
                    ->relationship('birthplace', 'name') // Usa a função no Model Candidate
                    ->searchable() // Permite pesquisar cidades
                    ->preload(),
                TextInput::make('father_name')
                    ->default(null),
                TextInput::make('father_profession_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('mother_name')
                    ->default(null),
                TextInput::make('mother_profession_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('spouse_name')
                    ->default(null),
                TextInput::make('spouse_profession_id')
                    ->numeric()
                    ->default(null),
                Toggle::make('has_siblings')
                    ->required(),
                TextInput::make('siblings_count')
                    ->numeric()
                    ->default(null),
                Toggle::make('has_children')
                    ->required(),
                TextInput::make('children_count')
                    ->numeric()
                    ->default(null),
                TextInput::make('children_age')
                    ->default(null),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
                Toggle::make('idle')
                    ->required(),
            ]);
    }
}
