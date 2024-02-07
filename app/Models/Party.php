<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Party extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'address', 'phone', 'attonery', 'case1_id'];

    protected $searchableFields = ['*'];

    public function case1()
    {
        return $this->belongsTo(Case1::class);
    }
}
