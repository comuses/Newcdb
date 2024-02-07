<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Retain extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'attorneyID',
        'caseID',
        'emplooyID',
        'date',
        'case1_id',
        'attorney_id',
        'employee_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
    ];

    public function case1()
    {
        return $this->belongsTo(Case1::class);
    }

    public function attorney()
    {
        return $this->belongsTo(Attorney::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
