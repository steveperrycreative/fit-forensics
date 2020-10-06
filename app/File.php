<?php

namespace App;

use App\Providers\PhpFitFileAnalysis;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function investigation()
    {
        return $this->belongsTo('App\Investigation');
    }
}
