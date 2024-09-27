<?php

namespace App\Http\Controllers;

use App\DataTables\DepartamentoDataTable;
use App\Models\Departamento;
use App\Services\DepartamentoService;
use App\Traits\ControllerPadraoTrait;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    use ControllerPadraoTrait;

    protected $model;
    protected $service;
    protected $dataTable;
    protected $paramsCreate;
    protected $paramsEdit;
    protected $paramsIndex;
    protected $view;
    protected $routeIndex;

    public function __construct() 
    {
        $this->model = Departamento::class;
        $this->service = DepartamentoService::class;
        $this->dataTable = DepartamentoDataTable::class;
        $this->paramsIndex = [
            'route' => route('departamentos.store'),
            'titulo' => 'Departamentos'
        ];
        $this->routeIndex = 'departamentos';
        $this->view = 'parametros';
    }
}
