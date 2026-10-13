<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketNote extends Model
{
   protected $fillable = [
       'ticket_id' ,'details', 'created_by' ];

    function person_created()
    {
        return $this->belongsTo(User::class ,'created_by','id');
    }
    
}
