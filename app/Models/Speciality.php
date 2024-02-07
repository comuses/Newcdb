<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Speciality extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['attorneyID', 'speciality', 'attorney_id'];

    protected $searchableFields = ['*'];

    public function attorney()
    {
        return $this->belongsTo(Attorney::class);
    }
}
