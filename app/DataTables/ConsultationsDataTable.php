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
use App\Models\consultations_disease_injuries;
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
        // $consultations = consultations::with('diseases_injuries:title')->select('consultations.*');
        // return datatables()
        //     ->eloquent($consultations)
        //     ->addColumn('action', function($row) {
        // return "<a href=". route('consultation.edit', $row->id). " class=\"btn btn-warning\">Edit</a> 
        //             <form action=". route('consultation.destroy', $row->id). " method= \"POST\" >". csrf_field() .
        //             '<input name="_method" type="hidden" value="DELETE">
        //             <button class="btn btn-danger" type="submit">Delete</button>
        //               </form>';
        //     })

        //     ->addColumn('diseases_injuries', function (consultations $consultations) {
        //         return $consultations->disease_injuries->map(function($diseases_injuries) { //map will illeterate na album
        //          //return str_limit($listener->listener_name, 30, '...');
        //          return "<li>".$diseases_injuries->title. "</li>";
        //         })->implode('<br>'); //lalagyan nya ng break, implode-returns the array string
        //     })

        //     ->addColumn('employees', function (consultations $consultations) {
        //         return $consultations->employees->map(function($employees) { //map will illeterate na album
        //          //return str_limit($listener->listener_name, 30, '...');
        //          return "<li>".$employees->name. "</li>";
        //         })->implode('<br>'); //lalagyan nya ng break, implode-returns the array string
        //     })

        //     ->addColumn('animals', function (consultations $consultations) {
        //             return $consultations->animals->map(function($animals) { //map will illeterate na album
        //              //return str_limit($listener->listener_name, 30, '...');
        //              return "<li>".$animals->petName. "</li>";
        //             })->implode('<br>'); //lalagyan nya ng break, implode-returns the array string
        //         })

          
        //     ->escapeColumns([]); 

        ///--no animal and diseases shown
        //  return datatables()
        //  ->eloquent($query)
        //   ->addColumn('action', function($row) {
        //         return "<a href=". route('consultation.edit', $row->id). " class=\"btn btn-warning\">Edit</a> 
        //          <form action=". route('consultation.destroy', $row->id). " method= \"POST\" >". csrf_field().
        //          '<input name="_method" type="hidden" value="DELETE">
        //          <button class="btn btn-danger" type="submit">Delete</button>
        //            </form>';
        //  })
        // // // ->addColumn('images', function ($Animals) {
        // // //     $url = asset("$Animals->img_path");
        // // //     return '<img src=' . $url . ' alt = "I am a pic" height="100" width="100">';
        // // // })
        
        //  ->rawColumns(['action']);

           $consultations = consultations::with(['diseases_injuries:title'])->select('consultations.*');
        //   $consultations = consultations::with('diseases_injuries:title')->select('consultations.*');
        //   $consultations = consultations::with('animals:petName')->select('consultations.*');

       //   $consultations =  consultations::with(['diseases_injuries','animals']);

          //  $animals =  Animal::with(['customer:id,firstName'])->select('animals.*');

            // $albums =  Album::with(['artist','listeners']); sample anu toh sample dalawa tables
        
          // $consultations = consultations::with('animals:petName')->select('consultations_diseases_injuries.*');

           return datatables()
               ->eloquent($consultations)
               ->addColumn('action', function($row) {
                         return "<a href=". route('consultation.edit', $row->id). " class=\"btn btn-warning\">Edit</a> 
                       <form action=". route('consultation.destroy', $row->id). " method= \"POST\" >". csrf_field() .
                       '<input name="_method" type="hidden" value="DELETE">
                       <button class="btn btn-danger" type="submit">Delete</button>
                         </form>';
               })
               
            //    ->addColumn('employees', function (consultations $consultations) {
            //     return $consultations->employees->map(function($employees) { //map will illeterate na album
            //      //return str_limit($listener->listener_name, 30, '...');
            //      return "<li>".$employees->name. "</li>";
            //     })->implode('<br>'); //lalagyan nya ng break, implode-returns the array string
            // })

            //    ->addColumn('animals', function (consultations $consultations) {
            //     return $consultations->animals->map(function($animals) { //map will illeterate na album
            //      //return str_limit($listener->listener_name, 30, '...');
            //      return "<li>".$animals->petName. "</li>";
            //     })->implode('<br>'); //lalagyan nya ng break, implode-returns the array string
            // })

            // ->addColumn('employees', function (consultations $consultations) {
            //     return $consultations->employees->map(function($employees) {
            //         return "<li>".$employees->name. "</li>";
            //     })->implode('<br>');
            // })

            // ->addColumn('animals', function (consultations $consultations) {
            //     return $consultations->animals->map(function($animals) {
            //         return "<li>".$animals->petName. "</li>";
            //     })->implode('<br>');
            // })

            // ->addColumn('employee', function (consultations $consultations) {
            //     return $consultations->employee->name;
            // }) 

            // ->addColumn('animals', function (consultations $consultations) {
            //     return $consultations->animals->petName;
            // }) 

            ->addColumn('diseases_injuries', function (consultations $consultations) {
                       return $consultations->diseases_injuries->map(function($diseases_injuries) { //map will illeterate na album
                        //return str_limit($listener->listener_name, 30, '...');
                        return "<li>".$diseases_injuries->title. "</li>";
                       })->implode('<br>'); //lalagyan nya ng break, implode-returns the array string
            })

            ->escapeColumns([]); 

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

          Column::make('employee_id')->title('Vet Incharged'),
        //  Column::make('employee')->name('employee.name')->title('Employee Incharged'),
          
        Column::make('animal_id')->title('Pet Name'),
         // Column::make('animals')->name('animals.petName')->title('animals'),

            Column::make('dateConsult'),
            Column::make('fees'),
          //  Column::make('disease_injuries_id')->title('Diseases/Injuries'),
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
