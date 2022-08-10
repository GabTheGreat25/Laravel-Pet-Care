<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\Customer;
use App\Models\animal;
use App\Models\Employee;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TransactionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $transaction =  Order::with(['customer:id,firstName','items:servname','pets:petName',])->select('service_orderinfo.*');

        return datatables()
               ->eloquent($transaction)
            ->addColumn('action', function($row) {
                         return "<a href=". route('transaction.edit', $row->service_orderinfo_id). " class=\"btn btn-warning\">Edit</a> 
                       <form action=". route('transaction.destroy', $row->service_orderinfo_id). " method= \"POST\" >". csrf_field() .
                       '<input name="_method" type="hidden" value="DELETE">
                       <button class="btn btn-danger" type="submit">Delete</button>
                         </form>';
               })
              
            ->addColumn('customer', function (Order $transaction) {
                return $transaction->customer->firstName;
            }) 

            ->addColumn('items', function (Order $transaction) {
                       return $transaction->items->map(function($items) { //map will illeterate na album
                        //return str_limit($listener->listener_name, 30, '...');
                        return "<li>".$items->servname. "</li>";
                       })->implode('<br>'); //lalagyan nya ng break, implode-returns the array string
            })

            ->addColumn('pets', function (Order $transaction) {
                       return $transaction->pets->map(function($pets) { //map will illeterate na album
                        //return str_limit($listener->listener_name, 30, '...');
                        return "<li>".$pets->petName. "</li>";
                       })->implode('<br>'); //lalagyan nya ng break, implode-returns the array string
            })

            // ->escapeColumns([]); 
            ->rawColumns(['customer','items','action','pets']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TransactionDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('transaction-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('service_orderinfo_id'),

          // Column::make('employee_id')->title('Vet Incharged'),
         Column::make('customer')->name('customer.firstName')->title('Customer'),
          
        // Column::make('animal_id')->title('Pet Name'),
         Column::make('pets')->name('pets.petName')->title('Customer Pet'),

            Column::make('schedule'),
            Column::make('status'),
          //  Column::make('disease_injuries_id')->title('Diseases/Injuries'),
            Column::make('items')->name('items.servname')->title('Services'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('action')
                ->exportable(false)
                ->printable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Transaction_' . date('YmdHis');
    }
}
