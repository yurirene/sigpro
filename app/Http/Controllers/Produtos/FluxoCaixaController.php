<?php

namespace App\Http\Controllers\Produtos;

use App\DataTables\Produtos\FluxoCaixaDataTable;
use App\Http\Controllers\Controller;
use App\Models\Produtos\FluxoCaixa;
use App\Services\Produtos\FluxoCaixaService;
use Illuminate\Http\Request;
use Throwable;

class FluxoCaixaController extends Controller
{

    public function create()
    {
        try {
            return view('produtos.fluxo-caixa.form', [
                'tipos' => FluxoCaixaService::validaSaldoInicial()
                    ? FluxoCaixa::TIPOS_ATIVOS
                    : FluxoCaixa::TIPOS
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('home')->with([
                'mensagem' => [
                    'status' => false,
                    'texto' => 'Algo deu Errado!'
                ]
            ]);
        }
    }

    public function edit(FluxoCaixa $fluxo)
    {
        try {
            return view('produtos.fluxo-caixa.form', [
                'fluxo' => $fluxo,
                'tipos' => FluxoCaixa::TIPOS_ATIVOS
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('home')->with([
                'mensagem' => [
                    'status' => false,
                    'texto' => 'Algo deu Errado!'
                ]
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            FluxoCaixaService::store($request->all());
            return redirect()->route('produtos.index')->with([
                'mensagem' => [
                    'status' => true,
                    'texto' => 'Operação realizada com Sucesso!'
                ],
                'aba' => 3
            ]);
        } catch (Throwable $th) {
            return redirect()->back()->with([
                'mensagem' => [
                    'status' => false,
                    'texto' => 'Algo deu Errado!'
                ],
                'aba' => 3
            ])
            ->withInput();
        }
    }

    public function update(FluxoCaixa $fluxo, Request $request)
    {
        try {
            FluxoCaixaService::update($fluxo, $request->all());
            return redirect()->route('produtos.index')->with([
                'mensagem' => [
                    'status' => true,
                    'texto' => 'Operação realizada com Sucesso!'
                ],
                'aba' => 3
            ]);
        } catch (Throwable $th) {
            return redirect()->back()->with([
                'mensagem' => [
                    'status' => false,
                    'texto' => 'Algo deu Errado!'
                ],
                'aba' => 3
            ])
            ->withInput();
        }
    }

    public function delete(FluxoCaixa $fluxo)
    {
        try {
            FluxoCaixaService::delete($fluxo);
            return redirect()->route('produtos.index')->with([
                'mensagem' => [
                    'status' => true,
                    'texto' => 'Operação realizada com Sucesso!'
                ],
                'aba' => 3
            ]);
        } catch (Throwable $th) {
            return redirect()->back()->with([
                'mensagem' => [
                    'status' => false,
                    'texto' => 'Algo deu Errado!'
                ],
                'aba' => 3
            ])
            ->withInput();
        }
    }

    public function fluxoCaixaDataTable(FluxoCaixaDataTable $fluxoCaixaDataTable)
    {
        return $fluxoCaixaDataTable->render('produtos.index');
    }
}
