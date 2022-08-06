<?php

namespace App\DataTables;

use App\Models\Customer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomerDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        $customer =  Customer::with(['user:id,email'])->select('customers.*');

        return datatables()
            ->eloquent($customer)
             ->addColumn('action', function($row) {
                    return "<a href=". route('customer.edit', $row->id). " class=\"btn btn-warning\">Edit</a> 
                    <form action=". route('customer.destroy', $row->id). " method= \"POST\" >". csrf_field().
                    '<input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                      </form>';
            })
            ->addColumn('user', function (Customer $customer) {
                return $customer->user->email;
            }) 
            ->addColumn('images', function ($employees) {
                $url = asset("$employees->img_path");
                return '<img src=' . $url . ' alt = "I am a pic" height="100" width="100">';
            })
            ->rawColumns(['action', 'images']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CustomerDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model)
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
                    ->setTableId('customers-table')
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
            Column::make('id'),
            Column::make('user')->name('user.email')->title('email'),
            Column::make('title'),
            Column::make('firstName'),
            Column::make('lastName'),
            Column::make('age'),
            Column::make('address'),
            Column::make('sex'),
            Column::make('phonenumber'),
            Column::make('images'),
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
        return 'Customers_' . date('YmdHis');
    }
}
