<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attorney extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'zipcode',
        'case1_id',
    ];

    protected $searchableFields = ['*'];

    public function case1()
    {
        return $this->belongsTo(Case1::class);
    }

    public function specialities()
    {
        return $this->hasMany(Speciality::class);
    }

    public function bars()
    {
        return $this->hasMany(Bar::class);
    }

    public function retains()
    {
        return $this->hasMany(Retain::class);
    }
}
