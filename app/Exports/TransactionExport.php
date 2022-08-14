<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles; 
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Auth;
use Maatwebsite\Excel\Concerns\Exportable;

class TransactionExport implements FromView
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View 
    {
        return view('exports.items',[
            'orders' =>  \App\Models\Order::with('customer','items','pets')->latest()->take("1")->get()
        ]);
    }
}