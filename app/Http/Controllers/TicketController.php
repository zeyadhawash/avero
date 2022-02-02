<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Resources\Ticket as TicketResource;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
 /**
 * @group   Ticket management
 *
 * APIs for managing  Ticket
 *
 * @authenticated
 *
 */

class TicketController extends BaseController
{
/**
     * display all Ticket
     *
     *
     */
    public function index()
    {
        $Ticket = Ticket::all();
        return $this->sendResponse(TicketResource::collection($Ticket), 'Ticket retrieved Successfully!' );
    }
 /**
     * store  Ticket
     *
     *@bodyParam user_id string
     *@bodyParam influencer_id string
     *@bodyParam service_id string\
      *@bodyParam payment_method string
     *@queryParam status string
     *@queryParam price string

     */

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'user_id'=>'required',
            'influencer_id'=>'required',
            'service_id'=>'required',
            'payment_method'=>'required',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error',$validator->errors() );
        }
        if ($request->has('status')) $input['status'] =$request->status;
        if ($request->has('price'))$input['price'] =$request->price;



        $Ticket = Ticket::create($input);
        return $this->sendResponse($Ticket, 'Ticket added Successfully!' );

    }

   /**
     * show  Ticket
     *
     *
     */
    public function show($id)
    {
        $Ticket = Ticket::find($id);
        if (is_null($Ticket)) {
            return $this->sendError('Ticket not found!' );
        }
        return $this->sendResponse(new TicketResource($Ticket), 'Service retireved Successfully!' );

    }


   /**
     * update  Ticket
     *
     *@bodyParam status string
     */
    public function update(Request $request, Ticket $ticket)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'status'=>'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }

           if ( $ticket->user_id != Auth::id()) {
            return $this->sendError('you dont have rights' , $validator->errors());
        }
        if ($request->has('status'))$ticket->status= $input['status'];
        if ($request->has('price'))$ticket->price=$input['price'] ;
        if ($request->has('payment_method'))$ticket->payment_method=$input['payment_method'] ;
        $ticket->status = $input['status'];

        $ticket->save();

        return $this->sendResponse(new TicketResource($ticket), 'ticket updated Successfully!' );

    }

   /**
     * destroy ticket
     *
     *
     */
    public function destroy(Ticket $ticket)
    {
        $errorMessage = [] ;

        if ( $ticket->user_id != Auth::id()) {
            return $this->sendError('you dont have rights' , $errorMessage);
        }
        $ticket->delete();
        return $this->sendResponse(new ticketResource($ticket), 'ticket deleted Successfully!' );

    }
}
