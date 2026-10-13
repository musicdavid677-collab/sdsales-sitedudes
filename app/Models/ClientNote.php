<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientNote extends Model
{
    public $table = '121_client_notes';
    
    protected $fillable = [
	    'client_id', 'login_location', 'login_username', 'login_password', 'login_email','other_domain','website_credentials',
	    'sms_num_1', 'sms_num_2', 'sms_num_3',
	    'gtp_num1', 'gtp_num2', 'gtp_num3',
	    'alt_num1', 'alt_num2', 'alt_num3','alt_num_label'
    ];
}
