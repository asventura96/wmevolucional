<?php

namespace App\Filament\Resources\StateCities\Pages;

use App\Filament\Resources\StateCities\StateCityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStateCities extends ListRecords
{
    protected static string $resource = StateCityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
