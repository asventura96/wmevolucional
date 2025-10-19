<?php

namespace App\Filament\Resources\ZodiacSigns\Pages;

use App\Filament\Resources\ZodiacSigns\ZodiacSignResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListZodiacSigns extends ListRecords
{
    protected static string $resource = ZodiacSignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
