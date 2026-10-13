<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesRepresentativeProfile extends Model
{
    use HasFactory;

    protected $table = 'sales_representative_profiles';

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'gender',
        'job_title',
        'phone',
        'address',
        'photo_id_front_path',
        'photo_id_back_path',
        'signature_path',
        'terms_accepted_at',
        'terms_version',
    ];

    protected $casts = [
        'terms_accepted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
