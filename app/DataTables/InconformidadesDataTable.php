<?php

namespace App\DataTables;

use App\Models\Inconformidade;
use App\Services\InconformidadeService;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InconformidadesDataTable extends DataTable
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
            ->addColumn('action', function($sql) {
                return view('inconformidades.actions', [
                    'route' => 'inconformidades',
                    'id' => $sql->id,
                ]);
            })
            ->editColumn('created_at', function($sql) {
                return Carbon::parse($sql->created_at)->format('d/m/y H:i');
            })
            ->editColumn('nivel_id', function($sql) {
                return "<span class='badge badge-pill bg-light-primary me-1'>" . $sql->nivel->nome . "</span>";
            })
            ->editColumn('departamento_id', function($sql) {
                return "<span class='badge badge-pill bg-light-success me-1'>" . $sql->departamento->nome . "</span>";
            })
            ->editColumn('tipo_acao_id', function($sql) {
                return "<span class='badge badge-pill bg-light-info me-1'>" . $sql->tipoAcao->nome . "</span>";
            })
            ->editColumn('origem_id', function($sql) {
                return "<span class='badge badge-pill bg-light-info me-1'>" . $sql->origem->nome . "</span>";
            })
            ->editColumn('status_id', function($sql) {
                return InconformidadeService::getStatus($sql);
            })
            ->editColumn('descricao', function($sql) {
                return substr($sql->descricao, 0, 60) . '...';;
            })
            ->rawColumns(['nivel_id', 'departamento_id', 'tipo_acao_id', 'origem_id', 'status_id']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Membro $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Inconformidade $model)
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
            ->setTableId('inconformidade-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1, 'asc')
            ->parameters([
                'buttons' => [
                    [
                        'text' => '<i class="fas fa-plus"></i> Novo Registro',
                        'className' => 'btn-novo-registro',
                        'extend' => "create"
                    ],
                    'excel',
                    'print'
                ]
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
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('created_at')->title('Data'),
            Column::make('codigo')->title('Código'),
            Column::make('tipo_acao_id')->title('Tipo de Ação'),
            Column::make('nivel_id')->title('Nível'),
            Column::make('departamento_id')->title('Departameto'),
            Column::make('origem_id')->title('Origem'),
            Column::make('descricao')->title('Descrição'),
            Column::make('status_id')->title('Status'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Inconformidades_' . date('YmdHis');
    }
}
