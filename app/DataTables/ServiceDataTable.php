<?php

namespace App\DataTables;

use App\Models\Service;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ServiceDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
             ->addColumn('action', function($row) {
                    return "<a href=". route('service.edit', $row->id). " class=\"btn btn-warning\">Edit</a> 
                    <form action=". route('service.destroy', $row->id). " method= \"POST\" >". csrf_field().
                    '<input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                      </form>';
            })
            ->addColumn('images', function ($services) { 
                        $images = explode('|',$services->img_path);
                        foreach ($images as $url) 
                        { 
                            return '<img src='.$url.' alt = "I am a Pic" height="100" width="100">';
                        } 
            })
            ->rawColumns(['action', 'images']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ServiceDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Service $model)
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
            ->setTableId('services-table')
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
            Column::make('servname')->title('serviceName'), // ? Title is yung header
            Column::make('description'),
            Column::make('price'),
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
        return 'Services_' . date('YmdHis');
    }
}
