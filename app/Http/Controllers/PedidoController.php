<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Services\PedidoService;
use App\Services\Produtos\ProdutoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class PedidoController extends Controller
{
    public function index(): View
    {
        return view('pedidos.index', [
            'produtos' => ProdutoService::getAllProdutos(),
            'pedidos' => PedidoService::getAllPedidos()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            PedidoService::store($request->all());
            return redirect()->route('pedidos.index')->with([
                'mensagem' => [
                    'status' => true,
                    'texto' => 'Pedido Registrado!'
                ]
            ]);
        } catch (Throwable $th) {
            return redirect()->back()->with([
                'mensagem' => [
                    'status' => false,
                    'texto' => $th->getMessage()
                ]
            ])
            ->withInput();
        }
    }

    public function pagar(Pedido $pedido): RedirectResponse
    {
        try {
            PedidoService::pagar($pedido);
            return redirect()->route('pedidos.index')->with([
                'mensagem' => [
                    'status' => true,
                    'texto' => 'Pedido Pago!'
                ]
            ]);
        } catch (Throwable $th) {
            return redirect()->back()->with([
                'mensagem' => [
                    'status' => false,
                    'texto' => $th->getMessage()
                ]
            ])
            ->withInput();
        }
    }

    public function cancelar(Pedido $pedido): RedirectResponse
    {
        try {
            PedidoService::delete($pedido);
            return redirect()->route('pedidos.index')->with([
                'mensagem' => [
                    'status' => true,
                    'texto' => 'Pedido Cancelado!'
                ]
            ]);
        } catch (Throwable $th) {
            return redirect()->back()->with([
                'mensagem' => [
                    'status' => false,
                    'texto' => $th->getMessage()
                ]
            ])
            ->withInput();
        }
    }
}
