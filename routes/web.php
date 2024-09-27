<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HelpdeskController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\Produtos\ConsignacaoProdutoController;
use App\Http\Controllers\Produtos\EstoqueProdutoController;
use App\Http\Controllers\Produtos\FluxoCaixaController;
use App\Http\Controllers\Produtos\ProdutoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [DashboardController::class, 'index'])
        ->name('home');
    Route::post('/trocar-senha', [DashboardController::class, 'trocarSenha'])
        ->name('trocar-senha');

    //USUARIOS
    Route::resource('usuarios', UserController::class)
        ->names('usuarios');
    Route::post('/usuarios-senha-reset/{usuario}', [UserController::class, 'resetSenha'])
        ->name('usuarios.reset-senha');

    Route::get('/usuarios-senha-resetar/{usuario}', [UserController::class, 'resetarSenha'])
        ->name('usuarios.resetar-senha');
    Route::post('/check-usuario', [UserController::class, 'checkUser'])
        ->name('usuarios.check-usuario');

    //PRODUTOS
    Route::resource('produtos', ProdutoController::class)
        ->parameters(['produtos' => 'produto'])
        ->names('produtos')->except('destroy');
    Route::get('/produtos/{produto}/delete', [ProdutoController::class, 'delete'])
        ->name('produtos.delete');
    Route::get('/produtos-datatable/produtos', [ProdutoController::class, 'produtoDataTable'])
        ->name('produtos.datatable.produtos');
    Route::get('/produtos-datatable/estoque', [ProdutoController::class, 'estoqueProdutosDataTable'])
        ->name('produtos.datatable.estoque');
    Route::get('/produtos-datatable/consignacao', [ProdutoController::class, 'consignacaoProdutosDataTable'])
        ->name('produtos.datatable.consignacao');

    // ESTOQUE
    Route::resource('estoque-produtos', EstoqueProdutoController::class)
        ->parameters(['estoque-produtos' => 'estoque'])
        ->names('estoque-produtos')->except(['index', 'show', 'destroy']);
    Route::get('/estoque-produtos/{estoque}/delete', [EstoqueProdutoController::class, 'delete'])
        ->name('estoque-produtos.delete');

    // CONSIGNACAO
    Route::resource('consignacao-produtos', ConsignacaoProdutoController::class)
        ->parameters(['consignacao-produtos' => 'consignado'])
        ->names('consignacao-produtos')
        ->except(['index', 'show', 'destroy']);
    Route::get('/consignacao-produtos/{consignado}/delete', [ConsignacaoProdutoController::class, 'delete'])
        ->name('consignacao-produtos.delete');

    // FLUXO CAIXA
    Route::resource('produtos/fluxo-caixa', FluxoCaixaController::class)
        ->parameters(['fluxo-caixa' => 'fluxo'])
        ->names('produtos.fluxo-caixa')
        ->except(['index', 'show', 'destroy']);
    Route::get('/produtos/fluxo-caixa/{fluxo}/delete', [FluxoCaixaController::class, 'delete'])
        ->name('produtos.fluxo-caixa.delete');
    Route::get('/produtos-datatable/fluxo-caixa', [FluxoCaixaController::class, 'fluxoCaixaDataTable'])
        ->name('produtos.datatable.fluxo-caixa');

    // PEDIDOS
    Route::resource('pedidos', PedidoController::class)
        ->names('pedidos')
        ->except(['create', 'show', 'edit', 'update', 'destroy']);

    Route::get('/pedidos/pagar/{pedido}', [PedidoController::class, 'pagar'])
        ->name('pedidos.pagar');
    Route::get('/pedidos/cancelar/{pedido}', [PedidoController::class, 'cancelar'])
        ->name('pedidos.cancelar');

    // HELPDESK
    Route::resource('/helpdesk', HelpdeskController::class)
        ->names('helpdesk')
        ->except(['update', 'destroy']);

});
