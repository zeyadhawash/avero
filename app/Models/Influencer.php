<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Influencer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'email','password',  'picture', 'country','categories','interesting','reach','age','followers','phone_number','photos'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'photos' => 'array',
        'categories' => 'array',
        'email_verified_at' => 'datetime',
    ];

    public function Story()
    {
        return $this->hasMany('App\Models\Story', 'influencer_id' );
    }
    public function Service()
    {
        return $this->belongsToMany('App\Models\Service' );
    }

    public function Ticket()
    {
        return $this->belongsToMany('App\Models\Ticket' ,"influencer_id");
    }

}
