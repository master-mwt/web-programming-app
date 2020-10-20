<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            ->addColumn('action', function($query){
                return
                '<div class="d-flex flex-column">
                    <a href="/users/'.$query->id.'" class="btn btn-sm btn-primary mb-2">show</a>
                    <a href="/users/'.$query->id.'/edit" class="btn btn-sm btn-success">edit</a>
                </div>';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1, 'asc')
                    ->buttons(
                        Button::make('pageLength'),
                        //Button::make('create')->action("window.location='".route('users.create')."';"),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    )
                    ->parameters([
                        'initComplete' => "function() {
                            this.api().columns('.filterable').every(function() {
                                var column = this;
                                var input = document.createElement(\"input\");
                                input.id = 'column-filter';
                                input.placeholder = 'filter';
                                $(input).addClass('form-control form-control-sm bg-dark');
                                $(input).appendTo($(column.footer()).empty()).on('keyup change clear', function() {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",

                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(100)
                  ->addClass('text-center'),
            Column::make('id')
                ->addClass('filterable'),
            Column::make('name')
                ->addClass('filterable'),
            Column::make('surname')
                ->addClass('filterable'),
            Column::make('username')
                ->addClass('filterable'),
            Column::make('birth_date')
                ->addClass('filterable'),
            Column::make('email')
                ->addClass('filterable'),
            Column::computed('email_verified_at')
                ->addClass('filterable'),
            // Column::make('password'),
            // Column::make('remember_token'),
            Column::make('group_id')
                ->addClass('filterable'),
            Column::make('image_id')
                ->addClass('filterable'),
            Column::make('hard_banned')
                ->addClass('filterable'),
            Column::computed('created_at')
                ->addClass('filterable'),
            Column::computed('updated_at')
                ->addClass('filterable'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
