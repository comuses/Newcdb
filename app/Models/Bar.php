<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bar extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['attorneyID', 'bar', 'attorney_id'];

    protected $searchableFields = ['*'];

    public function attorney()
    {
        return $this->belongsTo(Attorney::class);
    }
}
