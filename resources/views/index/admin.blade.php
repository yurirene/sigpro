@extends('layout.template')

@section('content')
    <div class="container-fluid mt-3">

        <div class="row">
            <div class="col-xl-7 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow h-100">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Acesso na Plataforma</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="card shadow h-100">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Logs de Errros</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="log-erros-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Data</th>
                                        <th class="text-center">Erro</th>
                                        <th class="text-center">Usuário Afetado</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
