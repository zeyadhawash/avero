<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Ticket extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [ 'user_id','influencer_id','service_id','status','price', 'payment_method'];

    public function User()
    {
        return $this->belongsTo('App\Models\User','user_id' );
    }
    public function Service()
    {
        return $this->belongsTo('App\Models\Service','service_id' );
    }
    public function Influencer()
    {
        return $this->belongsTo('App\Models\Influencer','influencer_id' );
    }
}
