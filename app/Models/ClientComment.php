<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ClientComment extends Model
{
    protected $table = '121_client_comments';
    protected $primaryKey = 'comment_id';
    protected $fillable = ['client_id', 'comment_type', 'comment', 'admin_person','tag_id','sticky'];

    function getCreatedAt() 
    {
    	//date_default_timezone_set('America/Toronto');
    	//$utcDate=date_create($this->date_time);
    	$utcDate=Carbon::createFromFormat('Y-m-d H:i:s', $this->date_time, 'UTC');
    	$localDate = $utcDate->timezone('America/Toronto');
    	return date_format($localDate, "m/d/Y g:i A");
        //return date_format(date_create($this->date_time), "m/d/Y H:i:s A");
    }    
}
