<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(Team::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function searchResults()
    {
        return $this->hasMany(SearchResult::class);
    }
}
