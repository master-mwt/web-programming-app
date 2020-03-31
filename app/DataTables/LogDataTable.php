<?php

namespace App\DataTables;

use App\Log;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LogDataTable extends DataTable
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
                    <a href="/logs/'.$query->id.'" class="btn btn-sm btn-primary mb-2">show</a>
                    <a href="/logs/'.$query->id.'/edit" class="btn btn-sm btn-success">edit</a>
                </div>';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Log $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Log $model)
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
                    ->setTableId('log-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1, 'asc')
                    ->buttons(
                        Button::make('pageLength'),
                        Button::make('create')->action("window.location='".route('logs.create')."';"),
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
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(100)
                  ->addClass('text-center'),
            Column::make('id')
                ->addClass('filterable'),
            Column::make('location')
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
        return 'Log_' . date('YmdHis');
    }
}
