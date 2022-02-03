<?php

namespace App\Http\Controllers;

use App\Models\Influencer;
use Illuminate\Http\Request;
use App\Http\Resources\Influencer as InfluencerResource;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
/**
 * @group  Influencer management
 *
 * APIs for managing Influencer
 * @authenticated
 *
 */
class InfluencerController extends BaseController
{
     /**
     * display all Influencer
     *
     *
     */
    public function index()
    {
        $Influencer = Influencer::all();
        return $this->sendResponse(InfluencerResource::collection($Influencer), 'Influencer retrieved Successfully!' );
    }

    /**
     * creat  Influencer
     *@bodyParam name string
     *@bodyParam email string
     *@bodyParam password string
      *@bodyParam picture file
     *@bodyParam Country string
     *@bodyParam Age string
     *@bodyParam phone_number string
     */

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'picture'=>'required',
            'country'=>'required',
            'categories' =>'required',
            'interesting' =>'string',
            'age'=>'required',
            'phone_number'=>'required',




        ]);
     //   dd(json_encode($request->imge));
        if ($validator->fails()) {
            return $this->sendError('Validate Error',$validator->errors() );
        }

        $picture = $request->picture;
        $newPhoto = time().$picture->getClientOriginalName();
        $picture->move('uploads/Influence',$newPhoto);

        
        $input['picture'] = 'uploads/Influence/'.$newPhoto;
        $input['photos']=  json_encode($request->photos);
        $input['categories']=  json_encode($request->categories);
        
        $Influencer = Influencer::create($input);
        return $this->sendResponse($Influencer, 'Influencer added Successfully!' );

    }

/**
     * show  Influencer
     *
     *
     */
    public function show($id)
    {
        $Influencer = Influencer::join('influencer_service','influencers.id','influencer_service.influencer_id')->join('services','services.id','influencer_service.service_id')->get();
        
        if (is_null($Influencer)) {
            return $this->sendError('influencer not found!' );
        }
        return $this->sendResponse(new InfluencerResource($Influencer), 'influencer retireved Successfully!' );

    }


/**
     * update  Influencer
     *@bodyParam name string
     *@bodyParam email string
     *@bodyParam password string
      *@queryParam picture file
     *@bodyParam Country string
     *@bodyParam Age string
     *@bodyParam phone_number string
     *
     */

    public function update(Request $request, Influencer $influencer)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'picture'=>'required',
            'Country'=>'required',
            'Age'=>'required',
            'phone_number'=>'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }
        if ($request->has('picture')) {
            $picture = $request->picture;
            $newPhoto = time().$picture->getClientOriginalName();
            $picture->move('uploads/posts',$newPhoto);
            $picture->picture ='uploads/posts/'.$newPhoto ;
        }


        if ( $influencer->user_id != Auth::id()) {
            return $this->sendError('you dont have rights' , $validator->errors());
        }
        $influencer->name = $input['name'];
        $influencer->email = $input['email'];
        $influencer->password = $input['password'];
        $influencer->picture = $input['picture'];
        $influencer->Country = $input['Country'];
        $influencer->phone_number = $input['phone_number'];
        $influencer->Age = $input['Age'];

        $influencer->save();

        return $this->sendResponse(new InfluencerResource($influencer), 'influencer updated Successfully!' );

    }
     /**
     * destroy  Influencer
     *
     *
     */

    public function destroy(Influencer $influencer)
    {
        $errorMessage = [] ;

        if ( $influencer->user_id != Auth::id()) {
            return $this->sendError('you dont have rights' , $errorMessage);
        }
        $influencer->delete();
        return $this->sendResponse(new InfluencerResource($influencer), 'influencer deleted Successfully!' );

    }
}
