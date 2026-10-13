<?php
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CustomerNotes extends model {



  
    public $table='121_client_notes'; 
    
    protected $guard = 'customer';

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     //replaced customer_id with client_id
    protected $fillable = [
        'client_id','client_notes', 'login_location', 'login_username', 'login_password', 'login_email', 'online_password', 'alt_num1' , 
        'alt_num2', 'alt_num3', 'sms_num_1','sms_num_2','sms_num_3'
    ];


    
    


/*    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    })*/

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

/*    public function comments()
    {
        return $this->hasMany(Comment::class,'user_id','id')->where('comments.user_type', USER_TYPE_CUSTOMER);
    }*/






    public function delete_has_many_relations($relations)
    {
        if(is_array($relations) && count($relations) > 0)
        {
            foreach($relations as $relation) 
            {
                $relation = $this->{$relation}()->get();

                if(count($relation) > 0)
                {
                    foreach ($relation as $r) 
                    {
                       $r->forcedelete();
                    }
                } 
            
                
            }
        }
    }



}