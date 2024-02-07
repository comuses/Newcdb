<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'zipcode',
        'telephone',
        'dob',
        'user_id',
        'case1_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'dob' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function case1()
    {
        return $this->belongsTo(Case1::class);
    }

    public function retains()
    {
        return $this->hasMany(Retain::class);
    }
}
