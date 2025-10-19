<?php

namespace App\Filament\Resources\Religions\Pages;

use App\Filament\Resources\Religions\ReligionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReligions extends ListRecords
{
    protected static string $resource = ReligionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
