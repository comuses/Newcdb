<?php

namespace App\Filament\Resources\PartyResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PartyResource;
use App\Filament\Traits\HasDescendingOrder;

class ListParties extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = PartyResource::class;
}
