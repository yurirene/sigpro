<?php

namespace App\Http\Controllers\Produtos;

use App\Http\Controllers\Controller;
use App\Models\Produtos\ConsignacaoProduto;
use App\Services\Produtos\ConsignacaoProdutoService;
use App\Services\Produtos\ProdutoService;
use Illuminate\Http\Request;

class ConsignacaoProdutoController extends Controller
{

    public function create()
    {
        return view('produtos.consignado-form', [
            'produtos' => ProdutoService::getAllProdutos()->pluck('nome', 'id'),
            'usuarios' => ConsignacaoProdutoService::getUsuarios()
        ]);
    }

    public function store(Request $request)
    {
        try {
            ConsignacaoProdutoService::store($request->all());
            return redirect()->route('produtos.index')->with([
                'mensagem' => [
                    'status' => true,
                    'texto' => 'Operação realizada com Sucesso!'
                ],
                'aba' => 2
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'mensagem' => [
                    'status' => false,
                    'texto' => 'Algo deu Errado!'
                ],
                'aba' => 2
            ])
            ->withInput();
        }
    }
    public function edit(ConsignacaoProduto $consignado)
    {
        return view('produtos.consignado-form', [
            'consignado' => $consignado,
            'produtos' => ProdutoService::getAllProdutos()->pluck('nome', 'id'),
            'usuarios' => ConsignacaoProdutoService::getUsuarios()
        ]);
    }

    public function update(ConsignacaoProduto $consignado, Request $request)
    {
        try {
            ConsignacaoProdutoService::update($consignado, $request->all());
            return redirect()->route('produtos.index')->with([
                'mensagem' => [
                    'status' => true,
                    'texto' => 'Operação realizada com Sucesso!'
                ],
                'aba' => 2
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'mensagem' => [
                    'status' => false,
                    'texto' => 'Algo deu Errado!'
                ],
                'aba' => 2
            ])
            ->withInput();
        }
    }

    public function delete(ConsignacaoProduto $consignado)
    {
        try {
            ConsignacaoProdutoService::delete($consignado);
            return redirect()->route('produtos.index')->with([
                'mensagem' => [
                    'status' => true,
                    'texto' => 'Operação realizada com Sucesso!'
                ],
                'aba' => 2
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'mensagem' => [
                    'status' => false,
                    'texto' => 'Algo deu Errado!'
                ],
                'aba' => 2
            ])
            ->withInput();
        }
    }
}
