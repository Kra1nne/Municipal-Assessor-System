<?php

namespace App\Http\Controllers\assessor;

use App\Http\Controllers\Controller;
use App\Models\Assessor;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class AssessorController extends Controller
{
    public function index()
    {
      $assessors = Assessor::whereNull('deleted_at')->orderBy('created_at', 'Desc')->get();
      return view('content.assessor.assessor_list', compact('assessors'));
    }
    public function store(Request $request)
    {
      Log::insert([
        'user_id' => Auth::id(),
        'action' => 'Add',
        'table_name' => 'Assessor',
        'description' => 'Added a Assessor',
        'ip_address' => request()->ip(),
        'created_at' => now(),
      ]);

      $data = Assessor::insert([
        'firstname' => $request->firstname,
        'middlename' => $request->middlename,
        'lastname' => $request->lastname,
        'address' => $request->address,
        'role' => $request->role,
        'phone' => $request->phone,
        'status' => "Active",
        'created_at' => now(),
      ]);

      if($data){
        return response()->json(['Error' => 0, 'Message' => 'Successfully added a data']);
      }
    }
    public function update(Request $request)
    {
      Log::insert([
        'user_id' => Auth::id(),
        'action' => 'Update',
        'table_name' => 'Assessor',
        'description' => 'Updated an Assessor',
        'ip_address' => request()->ip(),
        'created_at' => now(),
      ]);

      $data = [
        'firstname' => $request->firstname,
        'middlename' => $request->middlename,
        'lastname' => $request->lastname,
        'role' => $request->role,
        'address' => $request->address,
        'phone' => $request->phone,
        'updated_at' => now(),
      ];
      $assessor = Assessor::where('id', Crypt::decryptString($request->encrypted_id))->update($data);

      if($assessor){
        return response()->json(['Error' => 0, 'Message' => 'Successfully updated a data']);
      }
    }
    public function delete(Request $request)
    {
      Log::insert([
        'user_id' => Auth::id(),
        'action' => 'Delete',
        'table_name' => 'Assessor',
        'description' => 'Deleted an Assessor',
        'ip_address' => request()->ip(),
        'created_at' => now(),
      ]);

      $assessor = Assessor::where('id', Crypt::decryptString($request->id))->update([
        'deleted_at' => now(),
      ]);

      if($assessor){
        return response()->json(['Error' => 0, 'Message' => 'Successfully deleted a data']);
      }
    }
    public function save(Request $request)
    {
        $assessor = Assessor::where('id',Crypt::decryptString($request->id))->first();
        
        if ($assessor && $assessor->signature != null) {
            if (Storage::disk('public')->exists($assessor->signature)) {
                Storage::disk('public')->delete($assessor->signature);
            }
        }

        $now = date('Ymd_His');

        $data = str_replace('data:image/png;base64,', '', $request->signature);
        $data = str_replace(' ', '+', $data);

        $fileName = 'signature_' . $now . '.png';
        $path = Storage::disk('public')->put('signatures/' . $fileName, base64_decode($data));

        $data = [
          'signature' => 'signatures/'. $fileName,
          'updated_at' => now()
        ];
        $result = Assessor::where('id', Crypt::decryptString($request->id))->update($data);

        if(!$result){
          return response()->json(['Error' => 1, 'Message' => 'Data unable to save']);
        }

        return response()->json(['Error' => 0, 'Message' => 'Signature successfully created']);
    }
}
