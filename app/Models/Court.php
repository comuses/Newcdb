<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Court extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'city', 'state', 'zipcode', 'case1_id'];

    protected $searchableFields = ['*'];

    public function case1()
    {
        return $this->belongsTo(Case1::class);
    }

    public function judges()
    {
        return $this->hasMany(Judge::class);
    }
}
