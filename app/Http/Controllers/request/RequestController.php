<?php

namespace App\Http\Controllers\request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Requests;
use App\Models\Log;
use App\Models\Property;

class RequestController extends Controller
{
    public function index()
    {
      $property = Property::leftjoin('assessment', 'assessment.properties_id', '=', 'properties.id')
                  ->leftjoin('request', 'request.assessment_id', '=', 'assessment.id')
                  ->whereNull('properties.deleted_at')
                  ->whereNull('request.assessment_id')
                  ->select('assessment.id as id', 'properties.lot_number')
                  ->where('assessment.id', '!=', null)
                  ->get();

      $request = Requests::whereNull('request.deleted_at')
                  ->leftjoin('users', 'users.id', '=', 'request.users_id')
                  ->leftjoin('person', 'person.id', '=', 'users.person_id')
                  ->orderBy('request.created_at', 'desc')
                  ->select('request.*','users.*', 'person.*', 'request.id as request_id')
                  ->get();

      return view('content.request.request-list', compact('request','property'));
    }
    public function accept(Request $request){

      if($request->owner || $request->address || $request->tin){
        $property = Property::leftjoin('assessment', 'assessment.properties_id', '=', 'properties.id')
                        ->select('properties.*')
                        ->where('assessment.id', '=', $request->lot)
                        ->first();

        $data = [
          'owner' => $request->owner ?? $property->owner,
          'address' => $request->address ?? $property->address,
          'tin' => $request->tin ?? $property->tin,
          'previous_owner' => $request->owner == null ? $property->previous_owner : $request->owner,
        ];

        Property::where('id', $property->id)->update($data);
      }

      $data = [
        'assessment_id' => $request->lot,
        'status' => "Success",
        'updated_at' => now(),
      ];
      Requests::where('id', $request->id)->update($data);
      $log = [
        'user_id' => Auth::id(),
        'action' => 'Send',
        'table_name' => 'Request',
        'description' => 'Accept the Request',
        'ip_address' => request()->ip(),
        'created_at' => now(),
      ];
      $logData = Log::insert($log);

      if($logData){
        return response()->json(['Error' => 0, 'Message' => 'Successfully send the request.']);
      }
    }
    public function decline(Request $request){

      $data = [
        'status' => "Decline",
        'updated_at' => now(),
      ];
      Requests::where('id', $request->id)->update($data);
      $log = [
        'user_id' => Auth::id(),
        'action' => 'Update',
        'table_name' => 'Request',
        'description' => 'Decline a Request',
        'ip_address' => request()->ip(),
        'created_at' => now(),
      ];
      $logData = Log::insert($log);

      if($logData){
        return response()->json(['Error' => 0, 'Message' => 'Successfully Decline the Request.']);
      }
    }

}
