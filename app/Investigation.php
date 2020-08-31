<?php

namespace App;

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
        return $this->belongsTo('App\User');
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }
}
