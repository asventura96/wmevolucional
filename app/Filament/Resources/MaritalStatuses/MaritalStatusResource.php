<?php

namespace App\Filament\Resources\MaritalStatuses;

use App\Filament\Resources\MaritalStatuses\Pages\CreateMaritalStatus;
use App\Filament\Resources\MaritalStatuses\Pages\EditMaritalStatus;
use App\Filament\Resources\MaritalStatuses\Pages\ListMaritalStatuses;
use App\Filament\Resources\MaritalStatuses\Schemas\MaritalStatusForm;
use App\Filament\Resources\MaritalStatuses\Tables\MaritalStatusesTable;
use App\Models\MaritalStatus;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MaritalStatusResource extends Resource
{
    protected static ?string $model = MaritalStatus::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Estado Civil';

    public static function form(Schema $schema): Schema
    {
        return MaritalStatusForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MaritalStatusesTable::configure($table);
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
            'index' => ListMaritalStatuses::route('/'),
            'create' => CreateMaritalStatus::route('/create'),
            'edit' => EditMaritalStatus::route('/{record}/edit'),
        ];
    }
}
