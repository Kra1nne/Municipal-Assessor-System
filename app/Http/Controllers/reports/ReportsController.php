<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Property;

class ReportsController extends Controller
{
    public function index(){
      return view('content.reports.reports-list');
    }
    public function generateReports(Request $request)
    {
      $start = $request->start;
      $end = $request->end;

      $query = Property::leftJoin('assessment', 'properties.id', '=', 'assessment.properties_id')
          ->leftJoin('property_type', 'assessment.property_type', '=', 'property_type.id')
          ->leftJoin('market_value', 'assessment.market_id', '=', 'market_value.id')
          ->leftJoin('property_list', 'market_value.property_list', '=', 'property_list.id')
          ->leftjoin('building', 'building.assessment_id', '=','assessment.id')
          ->leftjoin('building_type', 'building.building_type', '=', 'building_type.id')
          ->whereNull('assessment.deleted_at')
          ->whereBetween('assessment.created_at', [$start, $end]);

      if ($request->value == "market_value") {

          $query->selectRaw("
              assessment.created_at AS created_at,
              properties.owner AS owner,
              properties.lot_number AS lot_number,
              property_list.name AS classification,
              (market_value.value * properties.area) AS value
          ");

      } elseif ($request->value == "assess") {

          $query->selectRaw("
              assessment.created_at AS created_at,
              properties.owner AS owner,
              properties.lot_number AS lot_number,
              property_list.name AS classification,
              (market_value.value * properties.area * (property_type.assessment_rate / 100)) AS value
          ");
      }
      elseif ($request->value == "residential") {

          $query->selectRaw("
              assessment.created_at AS created_at,
              properties.owner AS owner,
              properties.lot_number AS lot_number,
              property_list.name AS classification,
              (market_value.value * properties.area * (property_type.assessment_rate / 100)) AS value
          ");
          $query->where('property_list.name', '=', 'Residentials');
      }
      elseif ($request->value == "agricultural") {

          $query->selectRaw("
              assessment.created_at AS created_at,
              properties.owner AS owner,
              properties.lot_number AS lot_number,
              property_list.name AS classification,
              (market_value.value * properties.area * (property_type.assessment_rate / 100)) AS value
          ");
          $query->where('property_list.name', '=', 'Agricultural');
      }
      elseif ($request->value == "commercial") {

          $query->selectRaw("
              assessment.created_at AS created_at,
              properties.owner AS owner,
              properties.lot_number AS lot_number,
              property_list.name AS classification,
              (market_value.value * properties.area * (property_type.assessment_rate / 100)) AS value
          ");
          $query->where('property_list.name', '=', 'Commercial');
      }else{
          $query->selectRaw("
            assessment.created_at AS created_at,
            properties.owner AS owner,
            properties.lot_number AS lot_number,
            property_list.name AS classification,

            (
                SELECT SUM(
                    CAST(jt.val AS DECIMAL(10,3)) * building.construction_cost * (building_type.percentage / 100)
                )
                FROM building
                LEFT JOIN building_type ON building.building_type = building_type.id
                JOIN JSON_TABLE(
                    CONCAT('[\"', REPLACE(building.storey_size, ',', '\",\"'), '\"]'),
                    '$[*]' COLUMNS(val VARCHAR(20) PATH '$')
                ) AS jt
                WHERE building.assessment_id = assessment.id
            ) AS value
        ");
      }

      $properties = $query->get();

      $totalValue = collect($properties)->sum('value');
      $title = "Sample";

      $pdf = Pdf::loadView('pdf.reports', [
          'Reports'     => $properties,
          'TotalValue'  => $totalValue,
          'Title' => $title,
      ]);

      return $pdf->setPaper('A4', 'portrait')
                ->stream('Reports.pdf');
    }

}
