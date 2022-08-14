<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use App\Charts\dateConsultationChart;
Use App\Charts\diseasesinjuriesChart;
use App\Charts\transactionChart;
use Illuminate\Support\Carbon;
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
    return view('dashboard.index',compact('diseasesinjuriesChart'));

}

// public function search(Request $request){
//     $fromDate = $request->input('fromDate');
//     $toDate = $request -> input('toDate');

//     $query= DB::table('service_orderinfo')->select()
//     ->where('schedule', '>=', $fromDate)
//     ->where('schedule', '<=', $toDate)
//     ->get();

//     return view('dashboard.transac',compact('query','transaction'));
// }

public function searchdate(Request $request){
    // $fromDate = $request->input('fromDate');
  //  $toDate = $request -> input('toDate');

    // $fromDate = '2020-01-10';
    // $toDate = '2020-07-10';

    // $query= DB::table('service_orderinfo')->select()
    // ->whereDate('schedule', '=', date($fromDate))
    // ->get();


   $fromDate = $request->fromDate;
   $toDate = $request -> toDate;

   $transaction = DB::table('service_orderinfo')
   
         ->join('service_orderline','service_orderinfo.service_orderinfo_id','=','service_orderline.service_orderinfo_id')
         ->join('animals','service_orderline.animal_id','=','animals.id')
         ->join('services','service_orderline.service_id','=','services.id')

   //   ->groupBy('servname')
        ->whereBetween('service_orderinfo.schedule',[$fromDate, $toDate])
        // ->pluck(DB::raw('count(service_orderline.service_orderinfo_id) as total'),'servname')

        ->groupBy('service_orderinfo.schedule')
        ->pluck(DB::raw('count(service_orderline.service_orderinfo_id) as total'),'service_orderinfo.schedule')

        //->get();
      
      //  ->all();

        ->toArray();

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
        
   return view('dashboard.transac',compact('transactionChart'));
}


public function dashtransac(){

   $transaction = DB::table('service_orderinfo')
   
         ->join('service_orderline','service_orderinfo.service_orderinfo_id','=','service_orderline.service_orderinfo_id')
         ->join('animals','service_orderline.animal_id','=','animals.id')
         ->join('services','service_orderline.service_id','=','services.id')

      ->groupBy('service_orderinfo.schedule')
      ->pluck(DB::raw('count(service_orderline.service_orderinfo_id) as total'),'service_orderinfo.schedule')

      //   ->groupBy('servname')
      // ->pluck(DB::raw('count(service_orderline.service_orderinfo_id) as total'),'servname')
      
     ->toArray();

         $transactionChart = new transactionChart;
 
         $dataset = $transactionChart->labels(array_keys($transaction));
  
            $dataset= $transactionChart->dataset('Groomed', 'bar', array_values($transaction));
   
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
        
   return view('dashboard.transac',compact('transactionChart'));
}
}