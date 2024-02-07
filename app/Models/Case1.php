<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Case1 extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'partyID',
        'Action',
        'courtID',
        'attorneyID',
        'judgeID',
        'start_date',
        'end_date',
        'caseTyep',
        'caseStatus',
        'emplooyID',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function parties()
    {
        return $this->hasMany(Party::class);
    }

    public function courts()
    {
        return $this->hasMany(Court::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function attorneys()
    {
        return $this->hasMany(Attorney::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function retains()
    {
        return $this->hasMany(Retain::class);
    }
}
