<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\MarketValue;
use App\Models\Property;
use App\Models\Requests;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Analytics extends Controller
{
  public function index()
  {
    $marketValues = MarketValue::leftjoin('property_list', 'market_value.property_list', '=', 'property_list.id')
                        ->orderBy('market_value.created_at', 'Desc')
                        ->Select('market_value.*', 'property_list.name as type_name', 'property_list.id as list_id')
                        ->get();
    $properties = Property::leftjoin('assessment', 'properties.id', '=', 'assessment.properties_id')
                            ->leftjoin('property_type', 'assessment.property_type', '=', 'property_type.id')
                            ->leftjoin('market_value', 'assessment.market_id', '=', 'market_value.id')
                            ->leftjoin('property_list', 'market_value.property_list', '=', 'property_list.id')
                            ->leftjoin('request', 'request.assessment_id', '=', 'assessment.id')
                            ->where('request.users_id', '=', Auth::id())
                            ->where('request.assessment_id', '!=', null)
                            ->get();


    $count = Property::leftjoin('assessment', 'properties.id', '=', 'assessment.properties_id')
                            ->leftjoin('property_type', 'assessment.property_type', '=', 'property_type.id')
                            ->leftjoin('market_value', 'assessment.market_id', '=', 'market_value.id')
                            ->leftjoin('property_list', 'market_value.property_list', '=', 'property_list.id')
                            ->leftjoin('request', 'request.assessment_id', '=', 'assessment.id')
                            ->where('request.users_id', '=', Auth::id())
                            ->where('request.assessment_id', '!=', null)
                            ->count();

    $completecount = Requests::where('status', '=', 'Success')
                          ->where('users_id', '=', Auth::id())
                          ->count();
    $completepending = Requests::where('status', '=', 'Request')->count();


    $totalAssessedValue = $properties
      ->sum(function ($item) {
          return $item->area * $item->value * ($item->assessment_rate / 100);
      });
    $total = $this->formatAbbreviatedPHP($totalAssessedValue);
    $properties->transform(function ($item) {
      $item->encrypted = Crypt::encryptString($item->assessment_id);
        return $item;
    });

    $user = User::all();
    $activeUsers = User::whereNull('deleted_at')->count();
    $inactiveUsers = User::whereNotNull('deleted_at')->count();
    $log = Log::leftjoin('users', 'logs.user_id', '=', 'users.id')
                ->leftjoin('person', 'users.person_id', '=', 'person.id')
                ->select('logs.*', 'users.*', 'logs.created_at as created_at')
                ->orderby('logs.created_at', 'desc')
                ->limit(10)
                ->get();
    return view('content.dashboard.dashboards-analytics', compact('user', 'log', 'activeUsers', 'inactiveUsers','properties', 'total', 'count', 'completecount', 'completepending', 'marketValues'));
  }
  public function logslist(Request $request){
      $query = Log::leftjoin('users', 'logs.user_id', '=', 'users.id')
            ->leftjoin('person', 'users.person_id', '=', 'person.id')
            ->select('logs.*', 'users.*', 'person.*', 'logs.created_at as created_at');

      // Default: last 30 days (overridden if date range is set)
      $dateFrom = $request->filled('date_from')
          ? Carbon::parse($request->date_from)->startOfDay()
          : Carbon::now()->subDays(30);

      $dateTo = $request->filled('date_to')
          ? Carbon::parse($request->date_to)->endOfDay()
          : Carbon::now();

      $query->whereBetween('logs.created_at', [$dateFrom, $dateTo]);

      // Search: name, email, action, table
      if ($request->filled('search')) {
          $search = $request->search;
          $query->where(function($q) use ($search) {
              $q->where('person.firstname', 'like', "%{$search}%")
                ->orWhere('person.lastname', 'like', "%{$search}%")
                ->orWhere('users.email', 'like', "%{$search}%")
                ->orWhere('logs.action', 'like', "%{$search}%")
                ->orWhere('logs.table_name', 'like', "%{$search}%");
          });
      }

      // Filter by role
      if ($request->filled('role')) {
          $query->where('users.role', $request->role);
      }

      $log = $query->orderBy('logs.created_at', 'desc')->get();

      return view('content.logs-list.account-log', compact('log'));
  }
  private function formatAbbreviatedPHP($value) {
        $value = floatval($value);
        $absValue = abs($value);
        $formatted = '';

        if ($absValue >= 1_000_000_000) {
            $formatted = number_format($value / 1_000_000_000, 2) . 'B';
        } elseif ($absValue >= 1_000_000) {
            $formatted = number_format($value / 1_000_000, 2) . 'M';
        } elseif ($absValue >= 1_000) {
            $formatted = number_format($value / 1_000, 2) . 'K';
        } else {
            $formatted = number_format($value, 2);
        }

        return '₱' . $formatted;
    }
}
