<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function path()
    {
        return $this->investigation->id . '/' . $this->name;
    }

    public function investigation()
    {
        return $this->belongsTo(Investigation::class);
    }
}
