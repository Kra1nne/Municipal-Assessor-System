<?php

namespace App\Http\Controllers\market;

use App\Models\Log;
use App\Models\MarketValue;
use App\Models\PropertyList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MarketValueController extends Controller
{
    public function index()
    {
      $propertylist = PropertyList::orderBy('created_at', 'asc')->get();

      $marketValues = MarketValue::leftjoin('property_list', 'market_value.property_list', '=', 'property_list.id')
                        ->orderBy('market_value.created_at', 'Desc')
                        ->Select('market_value.*', 'property_list.name as type_name', 'property_list.id as list_id')
                        ->get();

      return view('content.market.market-value', compact('propertylist', 'marketValues'));
    }
    public function store(Request $request) {
      Log::insert([
        'user_id' => Auth::id(),
        'action' => 'Add',
        'table_name' => 'Market Value',
        'description' => 'Added a Market Value',
        'ip_address' => request()->ip(),
        'created_at' => now(),
      ]);

      $marketValue = MarketValue::insert([
        'property_list' => $request->type,
        'class' => $request->class,
        'value' => $request->value,
        'created_at' => now(),
      ]);

      if($marketValue){
        return response()->json(['Error' => 0, 'Message' => 'Successfully added a data']);
      }
    }
    public function update(Request $request) {
      Log::insert([
        'user_id' => Auth::id(),
        'action' => 'Update',
        'table_name' => 'Market Value',
        'description' => 'Updated a Market Value',
        'ip_address' => request()->ip(),
        'created_at' => now(),
      ]);

      $marketValue = MarketValue::where('id', Crypt::decryptString($request->id))->update([
        'property_list' => $request->type,
        'class' => $request->class,
        'value' => $request->value,
        'updated_at' => now(),
      ]);
      if($marketValue){
        return response()->json(['Error' => 0, 'Message' => 'Successfully updated the data']);
      }
    }
}
