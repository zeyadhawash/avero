<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Resources\Service as ServiceResource;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
 /**
 * @group   Service management
 *
 * APIs for managing  Service
 * @authenticated
 *
 */
class ServiceController extends BaseController
{
   /**
     * display all Service
     *
     *
     */
    public function index()
    {
        $Service = Service::all();
        return $this->sendResponse(ServiceResource::collection($Service), 'Service retrieved Successfully!' );
    }

 /**
     * store  Service
     * @authenticated
     * @bodyParam service string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'service'=>'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error',$validator->errors() );
        }

        $services = Service::create($input);
        return $this->sendResponse($services, 'Service added Successfully!' );

    }

    /**
     * show  Service
     *
     *
     */
    public function show($id)
    {
        $Service = Service::find($id);
        if (is_null($Service)) {
            return $this->sendError('Service not found!' );
        }
        return $this->sendResponse(new ServiceResource($Service), 'Service retireved Successfully!' );

    }

   /**
     * update  Service
     *
     *@bodyParam services string
     */
    public function update(Request $request, Service $service)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'services'=>'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }

           if ( $service->user_id != Auth::id()) {
            return $this->sendError('you dont have rights' , $validator->errors());
        }
        $service->services = $input['services'];

        $service->save();

        return $this->sendResponse(new ServiceResource($service), 'Service updated Successfully!' );

    }
 /**
     * destroy Service
     *
     *
     */
    public function destroy(Service $service)
    {
        $errorMessage = [] ;

        if ( $service->user_id != Auth::id()) {
            return $this->sendError('you dont have rights' , $errorMessage);
        }
        $service->delete();
        return $this->sendResponse(new ServiceResource($service), 'Service deleted Successfully!' );

    }
}
