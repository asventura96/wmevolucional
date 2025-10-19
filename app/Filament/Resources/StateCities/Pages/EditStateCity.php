<?php

namespace App\Filament\Resources\StateCities\Pages;

use App\Filament\Resources\StateCities\StateCityResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStateCity extends EditRecord
{
    protected static string $resource = StateCityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
