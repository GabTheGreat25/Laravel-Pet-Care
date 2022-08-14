<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\consultations;
use App\Models\diseases_injuries;
use App\Models\animal;
use App\Models\Employee;

class ConsultationsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
           $consultations =  consultations::with(['animal:id,petName','diseases_injuries:title','employee:id,name',])->select('consultations.*');
           return datatables()
               ->eloquent($consultations)
               ->addColumn('action', function($row) {
                         return "<a href=". route('consultation.edit', $row->id). " class=\"btn btn-warning\">Edit</a> 
                       <form action=". route('consultation.destroy', $row->id). " method= \"POST\" >". csrf_field() .
                       '<input name="_method" type="hidden" value="DELETE">
                       <button class="btn btn-danger" type="submit">Delete</button>
                         </form>';
               })
              

            ->addColumn('employee', function (consultations $consultations) {
                return $consultations->employee->name;
            }) 

            ->addColumn('animal', function (consultations $consultations) {
                return $consultations->animal->petName;
            }) 

            ->addColumn('diseases_injuries', function (consultations $consultations) {
                       return $consultations->diseases_injuries->map(function($diseases_injuries) { 
                      
                        return "<li>".$diseases_injuries->title. "</li>";
                       })->implode('<br>');
            })

            ->rawColumns(['diseases_injuries','animal','action','employee']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ConsultationsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(consultations $model)
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
                    ->setTableId('consultations-table')
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
            Column::make('employee')->name('employee.name')->title('Employee Incharged'),
            Column::make('animal')->name('animal.petName')->title('animals'),
            Column::make('dateConsult'),
            Column::make('fees'),
            Column::make('diseases_injuries')->name('diseases_injuries.title')->title('diseases_injuries'),
            Column::make('comment'),
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
        return 'Consultations_' . date('YmdHis');
    }
}
