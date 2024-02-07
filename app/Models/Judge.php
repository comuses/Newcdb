<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Judge extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'years', 'courtID', 'court_id'];

    protected $searchableFields = ['*'];

    public function court()
    {
        return $this->belongsTo(Court::class);
    }
}
