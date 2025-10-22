<?php

namespace App\Filament\Resources\Candidates\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CandidatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cpf')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('birth_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('zodiac_sign_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('religion_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('marital_status_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('birthplace_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('father_name')
                    ->searchable(),
                TextColumn::make('father_profession_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('mother_name')
                    ->searchable(),
                TextColumn::make('mother_profession_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('spouse_name')
                    ->searchable(),
                TextColumn::make('spouse_profession_id')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('has_siblings')
                    ->boolean(),
                TextColumn::make('siblings_count')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('has_children')
                    ->boolean(),
                TextColumn::make('children_count')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('children_age')
                    ->searchable(),
                IconColumn::make('idle')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
