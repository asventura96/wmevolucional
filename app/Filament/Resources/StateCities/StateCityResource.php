<?php

namespace App\Filament\Resources\StateCities;

use App\Filament\Resources\StateCities\Pages\CreateStateCity;
use App\Filament\Resources\StateCities\Pages\EditStateCity;
use App\Filament\Resources\StateCities\Pages\ListStateCities;
use App\Filament\Resources\StateCities\Schemas\StateCityForm;
use App\Filament\Resources\StateCities\Tables\StateCitiesTable;
use App\Models\StateCity;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StateCityResource extends Resource
{
    protected static ?string $model = StateCity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Cidades';

    public static function form(Schema $schema): Schema
    {
        return StateCityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StateCitiesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStateCities::route('/'),
            'create' => CreateStateCity::route('/create'),
            'edit' => EditStateCity::route('/{record}/edit'),
        ];
    }
}
