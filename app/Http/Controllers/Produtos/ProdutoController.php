<?php

namespace App\Http\Controllers\Produtos;

use App\DataTables\Produtos\ConsignacaoProdutosDataTable;
use App\DataTables\Produtos\EstoqueProdutosDataTable;
use App\DataTables\Produtos\FluxoCaixaDataTable;
use App\DataTables\Produtos\ProdutosDataTable;
use App\Http\Controllers\Controller;
use App\Models\Produtos\Produto;
use App\Services\Produtos\FluxoCaixaService;
use App\Services\Produtos\ProdutoService;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(
        ProdutosDataTable $produtosDataTable,
        EstoqueProdutosDataTable $estoqueProdutosDataTable,
        ConsignacaoProdutosDataTable $consignacaoProdutosDataTable,
        FluxoCaixaDataTable $fluxoCaixaDataTable
    )
    {
        return view('produtos.index', [
            'produtosDataTable' => $produtosDataTable->html(),
            'estoqueProdutosDataTable' => $estoqueProdutosDataTable->html(),
            'consignacaoProdutosDataTable' => $consignacaoProdutosDataTable->html(),
            'fluxoCaixaDataTable' => $fluxoCaixaDataTable->html()
        ]);
    }

    public function create()
    {
        return view('produtos.form');
    }

    public function store(Request $request)
    {
        try {
            ProdutoService::store($request->all());
            return redirect()->route('produtos.index')->with([
                'mensagem' => [
                    'status' => true,
                    'texto' => 'Operação realizada com Sucesso!'
                ]
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with([
                'mensagem' => [
                    'status' => false,
                    'texto' => 'Algo deu Errado!'
                ]
            ])
            ->withInput();
        }
    }
    public function edit(Produto $produto)
    {
        return view('produtos.form', [
            'produto' => $produto
        ]);
    }

    public function update(Produto $produto, Request $request)
    {
        try {
            ProdutoService::update($produto, $request->all());
            return redirect()->route('produtos.index')->with([
                'mensagem' => [
                    'status' => true,
                    'texto' => 'Operação realizada com Sucesso!'
                ]
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'mensagem' => [
                    'status' => false,
                    'texto' => 'Algo deu Errado!'
                ]
            ])
            ->withInput();
        }
    }

    public function delete(Produto $produto)
    {
        try {
            ProdutoService::delete($produto);
            return redirect()->route('produtos.index')->with([
                'mensagem' => [
                    'status' => true,
                    'texto' => 'Operação realizada com Sucesso!'
                ]
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'mensagem' => [
                    'status' => false,
                    'texto' => 'Algo deu Errado!'
                ]
            ])
            ->withInput();
        }
    }

    public function produtoDataTable(ProdutosDataTable $produtosDataTable)
    {
        return $produtosDataTable->render('produtos.index');
    }

    public function estoqueProdutosDataTable(EstoqueProdutosDataTable $estoqueProdutosDataTable)
    {
        return $estoqueProdutosDataTable->render('produtos.index');
    }

    public function consignacaoProdutosDataTable(ConsignacaoProdutosDataTable $consignacaoProdutosDataTable)
    {
        return $consignacaoProdutosDataTable->render('produtos.index');
    }
}
