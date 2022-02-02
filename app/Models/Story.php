<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    protected $fillable = [ 'influencer_id','stories','Views',];

    public function Influencer()
    {
        return $this->belongsTo('App\Models\Influencer','influencer_id' );
    }
}
