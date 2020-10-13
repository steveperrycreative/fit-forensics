<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchResult extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function investigation()
    {
        return $this->belongsTo(Investigation::class);
    }
}
