<?php

namespace App\DataTables;

use App\Key;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class KeyDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
        ->addColumn('action', 'keys.datatables_actions')
        ->addColumn('selected', function () {
            return '<input type="checkbox" name="selected_keys[]" />';
        })
        ->rawColumns(['action', 'selected'])
        ->addColumn('created_at', function (Key $key) {
            //return $key->created_at->diffForHumans();
            return $key->created_at->format('d/m/Y h:i A');
        })
        ->addColumn('expires', function (Key $key) {
            if (empty($key->expires)) {
                return 'Not Used';
            }

            return (\Carbon\Carbon::parse($key->expires))->diffForHumans();
            // return $key->created_at->format('d/m/Y h:i A');
        })
        ->addColumn('last_use', function (Key $key) {
            if (empty($key->last_use)) {
                return 'Not Used';
            }

            return (\Carbon\Carbon::parse($key->last_use))->diffForHumans();
            // return $key->created_at->format('d/m/Y h:i A');
        })
        ->addColumn('user_id', function (Key $key) {
            //return $key->created_at->diffForHumans();
            return $key->user->name;
        })
        ->addColumn('app_id', function (Key $key) {
            //return $key->created_at->diffForHumans();
            return $key->app->name;
        })
        ->addColumn('plan_id', function (Key $key) {
            //return $key->created_at->diffForHumans();
            return $key->plan->name;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Key $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Key $model)
    {
        return $model->newQuery()->with(['user', 'plan', 'app'])->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => false,
                'order'     => [[3, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner'],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner'],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner'],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner'],
                ],
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
            'selected'=> ['title' => 'Delete', 'searchable' => false, 'orderable' => false],
            'key',
            'plan_id' => ['title' => 'Plan'],
            'created_at' => ['title' => 'Created'],
            'app_id' => ['title' => 'App'],
            'expires',
            'user_id' => ['title' => 'User'],
            'hwid',
            'email',
            'last_use',

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'keysdatatable_'.time();
    }
}
