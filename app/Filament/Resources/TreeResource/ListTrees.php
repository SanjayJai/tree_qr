<?php

namespace App\Filament\Resources\TreeResource\Pages;

use App\Filament\Resources\TreeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTrees extends ListRecords
{
    protected static string $resource = TreeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
