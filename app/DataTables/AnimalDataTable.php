<?php

namespace App\DataTables;

use App\Models\Animal;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AnimalDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
         $animals =  Animal::with(['customer:id,firstName'])->select('animals.*');

        return datatables()
            ->eloquent($animals)
             ->addColumn('action', function($row) {
                    return "<a href=". route('animal.edit', $row->id). " class=\"btn btn-warning\">Edit</a> 
                    <form action=". route('animal.destroy', $row->id). " method= \"POST\" >". csrf_field().
                    '<input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                      </form>';
            })
            ->addColumn('customer', function (Animal $animals) {
                    return $animals->customer->firstName;
                }) 
            ->addColumn('images', function ($Animals) {
                $url = asset("$Animals->img_path");
                return '<img src=' . $url . ' alt = "I am a pic" height="100" width="100">';
            })
            ->rawColumns(['customer','action','images']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AnimalDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Animal $model)
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
                    ->setTableId('Animals-table')
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
            Column::make('customer')->name('customer.firstName')->title('Owner'),
            Column::make('petName'),
            Column::make('Age'),
            Column::make('Type'),
            Column::make('Breed'),
            Column::make('Sex'),
            Column::make('Color'),
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
        return 'Animals_' . date('YmdHis');
    }
}
