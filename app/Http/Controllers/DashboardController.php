<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use App\Charts\dateConsultationChart;
Use App\Charts\diseasesinjuriesChart;
use App\Charts\transactionChart;

class DashboardController extends Controller
{
    //

    public function __construct(){
        $this->bgcolor = collect(['rgba(166, 8, 8, 0.56)','rgba(166, 160, 8, 0.58)', 'rgba(60, 8, 166, 0.58)',"rgba(166, 74, 8, 0.58)", "rgba(8, 102, 166, 0.58)", "rgba(8, 166, 105, 0.58)", "rgba(8, 42, 166, 0.58)", "rgba(8, 145, 166, 0.58)", "rgba(116, 8, 166, 0.58)", "#01FF70", "#85144b", "rgba(166, 89, 8, 0.58)", "rgba(8, 166, 97, 0.58)", "rgba(8, 166, 134, 0.58)", "rgba(8, 95, 166, 0.58)"]);
    }

    public function index(){
        
       $diseases_injuries = DB::table('diseases_injuries')
        ->join('consultations_diseases_injuries','diseases_injuries.id', '=', 'consultations_diseases_injuries.diseases_injuries_id')
        ->join('consultations','consultations.id', '=', 'consultations_diseases_injuries.consultations_id')
        ->join('animals','animals.id', '=', 'consultations.animal_id')
        ->groupBy('title')
        ->pluck(DB::raw('count(petName) as total'),'title')
        ->all();

     $diseasesinjuriesChart = new diseasesinjuriesChart;

    $dataset = $diseasesinjuriesChart->labels(array_keys($diseases_injuries));

    $dataset= $diseasesinjuriesChart->dataset('Pet Diseases/Injuries', 'polarArea', array_values($diseases_injuries));

     $dataset= $dataset->backgroundColor($this->bgcolor);
    
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
                ]],
        ],
    ]);


   $transaction = DB::table('service_orderinfo')
         ->join('service_orderline','service_orderinfo.service_orderinfo_id','=','service_orderline.service_orderinfo_id')
         ->join('animals','service_orderline.animal_id','=','animals.id')
        //  ->join('services','service_orderline.service_id','=','services.id')
        // ->where('')
        ->whereYear('schedule', date('2022'))
         ->groupBy('schedule')
         ->pluck  (DB::raw('count(service_orderline.service_orderinfo_id) AS total'),DB::raw('monthname(schedule) AS month'))

         ->all();

         $transactionChart = new transactionChart;
 
         $dataset = $transactionChart->labels(array_keys($transaction));
  
            $dataset= $transactionChart->dataset('Monthly groomed', 'bar', array_values($transaction));
   
            $dataset= $dataset->backgroundColor($this->bgcolor);
            $dataset = $dataset->fill(false);
          
            $transactionChart->options([
                'responsive' => true,
                'legend' => ['display' => true],
                'tooltips' => ['enabled'=>true],
                'aspectRatio' => 1,
                'scaleBeginAtZero' =>true,
                'scales' => [
                    'yAxes'=> [[
                        'display'=>true,
                        'type'=>'linear',
                        'ticks'=> [
                            'beginAtZero'=> true,
                             'autoSkip' => true,
                             'maxTicksLimit' =>20000,
                             'min'=>0,
                            // 'max'=>20000,
                            'stepSize' => 500
                        ]],
                       'gridLines'=> ['display'=> false],
                    ],
                    'xAxes'=> [
                        'categoryPercentage'=> 0.8,
                        'barPercentage' => 1,
                        'gridLines' => ['display' => false],
                        'display' => true,
                        'ticks' => [
                         'beginAtZero' => true,
                         'min'=> 0,
                         'stepSize'=> 10,
                        ]
                    ]
                ]
            ]);
        
   return view('dashboard.index',compact('diseasesinjuriesChart','transactionChart'));
}

}