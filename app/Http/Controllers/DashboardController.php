<?php

namespace App\Http\Controllers;

use App\Services\LogErroService;
use App\Services\Produtos\FluxoCaixaService;
use App\Services\Produtos\ProdutoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        return view('home', [
            'totalizadores' => ProdutoService::getTotalizadoresProdutos(),
            'totalizadores_fluxo' => FluxoCaixaService::getTotalizadores()
        ]);
    }

    public function trocarSenha(Request $request)
    {
        $usuario = Auth::user();
        if (!Hash::check($request->antiga_senha, $usuario->password)) {
            return redirect()->back()->with([
                'mensagem' => [
                    'status' => false,
                    'texto' => 'Senha Antiga Inválida!'
                ]
            ]);
        }
        try {
            $request->user()->fill([
                'password' => Hash::make($request->nova_senha)
            ])->save();

            return redirect()->back()->with([
                'mensagem' => [
                    'status' => true,
                    'texto' => 'Operação realizada com Sucesso!'
                ]
            ]);
        } catch (\Throwable $th) {
            LogErroService::registrar([
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile()
            ]);
            return redirect()->back()->with([
                'mensagem' => [
                    'status' => false,
                    'texto' => 'Algo deu Errado!'
                ]
            ]);
        }
    }
}
