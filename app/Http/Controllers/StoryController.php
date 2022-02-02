<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Influencer;
use Illuminate\Http\Request;
use App\Http\Resources\Story as StoryResource;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
/**
 * @group   Story  management
 *
 * APIs for managing  Story
 * @authenticated
 *
 */
class StoryController extends Controller
{
  // Route::get('posts/user/{id}', 'PostController@userPosts');

  /**
 *  InfluencerStory  management
 *
 *
 */
  public function InfluencerStory($id)
  {
  $Story = Story::where('influencer_id' , $id)->get();
  return $this->sendResponse(StoryResource::collection($Story), 'Story retrieved Successfully!' );
  }

    /**
     * creat  Story
     *@bodyParam stories string
     */

    public function store(Request $request)////9098
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'stories'=>'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validate Error',$validator->errors() );
        }

        $user = Auth::user();
        $input['influencer_id'] = $user->id;



    }

  /**
     * show  story
     *
     *
     */
    public function show($id)
    {
        $Story = Story::find($id);
        if (is_null($Story)) {
            return $this->sendError('influencer not found!' );
        }
        return $this->sendResponse(new StoryResource($Story), 'influencer retireved Successfully!' );
    }




     /**
     * destroy  story
     *
     *
     */
    public function destroy(Story $story)
    {
        $errorMessage = [] ;

        if ( $story->user_id != Auth::id()) {
            return $this->sendError('you dont have rights' , $errorMessage);
        }
        $story->delete();
        return $this->sendResponse(new StoryResource($story), 'influencer deleted Successfully!' );
    }
}
