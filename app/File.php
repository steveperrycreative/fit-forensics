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

    public function getType($fitData)
    {
        $tmp = $fitData->enumData('file', $fitData->data_mesgs['file_id']['type']);

        return is_array($tmp) ? $tmp[0] : $tmp;
    }

    public function analyse($path)
    {
        return new PhpFitFileAnalysis($path);
    }

    public function investigation()
    {
        return $this->belongsTo('App\Investigation');
    }
}
