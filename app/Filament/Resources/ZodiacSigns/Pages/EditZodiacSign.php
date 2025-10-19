<?php

namespace App\Filament\Resources\ZodiacSigns\Pages;

use App\Filament\Resources\ZodiacSigns\ZodiacSignResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditZodiacSign extends EditRecord
{
    protected static string $resource = ZodiacSignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
