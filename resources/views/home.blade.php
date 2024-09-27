@extends('layout.template')
@section('title')
    Início
@endsection
@section('content')
<section class="row">
    <div class="col-12 col-lg-12">
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row ">
                            <div class="col-md-3" >
                                <div class="stats-icon purple">
                                    <i class="iconly-boldBag-2"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Produtos em Estoque</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalizadores['total_produtos'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-3" >
                                <div class="stats-icon blue">
                                    <i class="iconly-boldWallet"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Valor em Estoque</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalizadores['valor_produtos'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-3" >
                                <div class="stats-icon purple">
                                    <i class="iconly-boldBag-2"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Produtos Consignados</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalizadores['total_consignado'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-3" >
                                <div class="stats-icon blue">
                                    <i class="iconly-boldWallet"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Valor Consignado</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalizadores['valor_consignado'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-3" >
                                <div class="stats-icon green">
                                    <i class="iconly-boldArrow---Down"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Entradas</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalizadores_fluxo['entradas'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-3" >
                                <div class="stats-icon red">
                                    <i class="iconly-boldArrow---Up"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Saídas</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalizadores_fluxo['saidas'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-3" >
                                <div class="stats-icon green">
                                    <i class="iconly-boldWallet"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Saldo</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalizadores_fluxo['saldo'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@push('js')

@endpush
