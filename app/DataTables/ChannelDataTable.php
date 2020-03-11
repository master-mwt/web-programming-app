<?php

namespace App\DataTables;

use App\Channel;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ChannelDataTable extends DataTable
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
                    <a href="{{ }}" class="btn btn-sm btn-success mb-2">edit</a>
                    <a href="{{ }}" class="btn btn-sm btn-primary">delete</a>
                </div>';
            })
            // ->addColumn('posts', function($query){
            //     return '<a href="{{ }}" class="btn btn-sm btn-secondary btn-block">posts</a>';
            // })
            // ->addColumn('members', function($query){
            //     return '<a href="{{ }}" class="btn btn-sm btn-secondary btn-block">members</a>';
            // })
            // ->rawColumns(['action','posts','members']);
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Channel $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Channel $model)
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
                    ->setTableId('channel-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1, 'asc')
                    ->buttons(
                        Button::make('pageLength'),
                        Button::make('create'),
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
            Column::make('description')
                ->addClass('filterable'),
            // Column::make('rules')
            //     ->addClass('filterable'),
            Column::make('image_id')
                ->addClass('filterable'),
            Column::make('creator_id')
                ->addClass('filterable'),
            Column::computed('created_at')
                ->addClass('filterable'),
            Column::computed('updated_at')
                ->addClass('filterable'),
            // Column::computed('posts')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(100)
            //       ->addClass('text-center'),
            // Column::computed('members')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(100)
            //       ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Channel_' . date('YmdHis');
    }
}
