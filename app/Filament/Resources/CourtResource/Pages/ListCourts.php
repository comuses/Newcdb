<?php

namespace App\Filament\Resources\CourtResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CourtResource;
use App\Filament\Traits\HasDescendingOrder;

class ListCourts extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = CourtResource::class;
}
