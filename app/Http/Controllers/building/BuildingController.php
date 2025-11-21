<?php

namespace App\Http\Controllers\building;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\BuildingType;

class BuildingController extends Controller
{
  public function index()
  {
    $class = BuildingType::whereNull('deleted_at')->orderBy('created_at', 'Desc')->get();
    return view('content.building.building-rate', compact('class'));
  }
  public function store(Request $request)
  {
   $data = [
      'classification' => $request->class,
      'minimum_rate' => $request->min,
      'maximum_rate' => $request->max,
      'percentage' => $request->percentage,
      'created_at' => now(),
    ];
    BuildingType::insert($data);
    $buildingLog = Log::insert([
      'user_id' => Auth::id(),
      'action' => 'Add',
      'table_name' => 'BuildingType',
      'description' => 'Added Building Classification',
      'ip_address' => request()->ip(),
      'created_at' => now(),
    ]);

    if($buildingLog){
      return response()->json(['Error' => 0, 'Message' => 'Successfully added a data']);
    }
  }
  public function update(Request $request)
  {
    $data = [
      'classification' => $request->class,
      'minimum_rate' => $request->min,
      'maximum_rate' => $request->max,
      'percentage' => $request->percentage,
      'updated_at' => now(),
    ];
    BuildingType::where('id', $request->id)->update($data);
    $buildingLog = Log::insert([
      'user_id' => Auth::id(),
      'action' => 'Update',
      'table_name' => 'BuildingType',
      'description' => 'Updated Building Classification',
      'ip_address' => request()->ip(),
      'created_at' => now(),
    ]);

    if($buildingLog){
      return response()->json(['Error' => 0, 'Message' => 'Successfully updated a data']);
    }
  }
  public function delete(Request $request)
  {
     $data = [
      'deleted_at' => now(),
    ];
    BuildingType::where('id', $request->id)->update($data);
    $buildingLog = Log::insert([
      'user_id' => Auth::id(),
      'action' => 'Delete',
      'table_name' => 'BuildingType',
      'description' => 'Deleted Building Classification',
      'ip_address' => request()->ip(),
      'created_at' => now(),
    ]);

    if($buildingLog){
      return response()->json(['Error' => 0, 'Message' => 'Successfully deleted a data']);
    }
  }

}
