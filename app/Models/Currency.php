<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model {


    function scopeDefault($query)
    {
        $query->where('is_default', TRUE);
    }

}