<?php

namespace App\Filament\Resources\Case1Resource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Case1Resource;
use App\Filament\Traits\HasDescendingOrder;

class ListCase1s extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = Case1Resource::class;
}
