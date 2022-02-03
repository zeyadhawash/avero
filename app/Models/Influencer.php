<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Influencer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'email','password',  'picture', 'Country','Reach','Age','Following','phone_number','photos'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'photos' => 'array',
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

    public function Countrie()
    {
        return $this->belongsTo('App\Models\Countrie','Country' );
    }



    public function Countrys()

    {
        return $this->belongsTo('App\Models\Countrys', 'Country' );
    }



}
