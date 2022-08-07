<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use App\Charts\dateConsultationChart;
Use App\Charts\diseasesinjuriesChart;

class DashboardController extends Controller
{
    //

    public function __construct(){
        $this->bgcolor = collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]);
    }

    public function index(){
        
        // $items = DB::table('orderline AS ol')
        // ->join('item AS i','ol.item_id','=','i.item_id')
        // ->groupBy('i.description')
        // ->pluck(DB::raw('sum(ol.quantity) AS total'),'description')
        // ->all();

    // $albums = DB::table('albums')
    //     ->join('album_listener','albums.id', '=', 'album_listener.album_id')
    //     ->join('listeners','listeners.id', '=', 'album_listener.listener_id')
    //     ->groupBy('genre')
    //     ->pluck(DB::raw('count(listener_name) as total'),'genre')
    //     ->all();

       $diseases_injuries = DB::table('diseases_injuries')
        ->join('consultations_diseases_injuries','diseases_injuries.id', '=', 'consultations_diseases_injuries.diseases_injuries_id')
        ->join('consultations','consultations.id', '=', 'consultations_diseases_injuries.consultations_id')
        ->join('animals','animals.id', '=', 'consultations.animal_id')
        ->groupBy('title')
        ->pluck(DB::raw('count(petName) as total'),'title')
        ->all();

// dd($items);
        $diseasesinjuriesChart = new diseasesinjuriesChart;
    // dd(array_values($customer));
    $dataset = $diseasesinjuriesChart->labels(array_keys($diseases_injuries));
    // dd($dataset);
    $dataset= $diseasesinjuriesChart->dataset('Pet Diseases/Injuries', 'polarArea', array_values($diseases_injuries));
    // dd($customerChart);
     $dataset= $dataset->backgroundColor($this->bgcolor);
    
    // dd($customerChart);
    $dataset = $dataset->fill(false);
    $diseasesinjuriesChart->options([
        'responsive' => true,
        'legend' => ['display' => true],
        'tooltips' => ['enabled'=>true],
        'aspectRatio' => 1,
        'scales' => [
         
            'yAxes'=> [
                'display'=>true,
                'ticks'=> ['beginAtZero'=> true],
                'gridLines'=> ['display'=> false],
                'stacked'=> ['stacked'=> true],
              ],
            'xAxes'=> [
                'categoryPercentage'=> 0.8,
                //'barThickness' => 100,
                'barPercentage' => 1,
                'gridLines' => ['display' => false],
                'display' => true,
                'ticks' => [
                    'beginAtZero' => true,
                    'min'=> 0,
                    'stepSize'=> 10,
                ]
            ]
        ],
    ]);
   // dd($salesChart);
   return view('dashboard.index',compact('diseasesinjuriesChart'));
}
}