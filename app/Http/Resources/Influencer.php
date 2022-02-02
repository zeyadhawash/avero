<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Influencer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
       // '', '','',  '', '','','','','phone_number',''
       return [

        'id'	        => $this->id,
        'name'	        => $this->name,
        'email'		    => $this->email,
        'password'    	=> $this->password,
        'Country'		    => $this->Country,
        'Reach'	=> $this->Reach,
        'Age'	=> $this->Age,
        'Following'	=> $this->Following,
        'phone_number'	=> $this->phone_number,
        'photos'	=> $this->photos,

        'created_at'	=> $this->created_at->format('d/m/Y'),
        'updated_at'	=> $this->updated_at->format('d/m/Y'),
      ];
    }
}
