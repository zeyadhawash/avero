<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countrie extends Model
{
    use HasFactory;
    protected $fillable = [ 'countrie_name', ];
    public function Influencer()
    {
        return $this->belongsToMany('App\Models\Influencer' );
    }
}
