<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [ 'service', ];

    public function Influencer()
    {
        return $this->belongsToMany('App\Models\Influencer' );
    }
}
