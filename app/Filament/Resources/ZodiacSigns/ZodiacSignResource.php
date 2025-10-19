<?php

namespace App\Filament\Resources\ZodiacSigns;

use App\Filament\Resources\ZodiacSigns\Pages\CreateZodiacSign;
use App\Filament\Resources\ZodiacSigns\Pages\EditZodiacSign;
use App\Filament\Resources\ZodiacSigns\Pages\ListZodiacSigns;
use App\Filament\Resources\ZodiacSigns\Schemas\ZodiacSignForm;
use App\Filament\Resources\ZodiacSigns\Tables\ZodiacSignsTable;
use App\Models\ZodiacSign;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ZodiacSignResource extends Resource
{
    protected static ?string $model = ZodiacSign::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Signos';

    public static function form(Schema $schema): Schema
    {
        return ZodiacSignForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ZodiacSignsTable::configure($table);
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
            'index' => ListZodiacSigns::route('/'),
            'create' => CreateZodiacSign::route('/create'),
            'edit' => EditZodiacSign::route('/{record}/edit'),
        ];
    }
}
