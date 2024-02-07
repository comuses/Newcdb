<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'caseID',
        'eventType',
        'date',
        'time',
        'location',
        'outcome',
        'case1_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
    ];

    public function case1()
    {
        return $this->belongsTo(Case1::class);
    }
}
