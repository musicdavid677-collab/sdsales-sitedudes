<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadStatus extends Model {

    use SoftDeletes;

    protected $table = 'lead_statuses';
    protected $dates = ['deleted_at'];



}