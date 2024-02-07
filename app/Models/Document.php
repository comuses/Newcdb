<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'caseID',
        'documentType',
        'dateFiled',
        'description',
        'case1_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'dateFiled' => 'date',
    ];

    public function case1()
    {
        return $this->belongsTo(Case1::class);
    }
}
