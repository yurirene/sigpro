<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LojaController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
   
    Route::resource('clientes', ClienteController::class)->names('clientes')->except(['destroy']); 
    Route::get('/clientes-delete/{cliente}', [ClienteController::class, 'delete'])->name('clientes.delete');
    
    Route::resource('lojas', LojaController::class)->names('lojas')->except(['destroy']); 
    Route::get('/lojas-delete/{loja}', [LojaController::class, 'delete'])->name('lojas.delete');
   
    Route::resource('funcionarios', FuncionarioController::class)->names('funcionarios')->except(['destroy']); 
    Route::get('/funcionarios-delete/{funcionario}', [FuncionarioController::class, 'delete'])->name('funcionarios.delete');

    Route::resource('usuarios', UsuarioController::class)->names('usuarios')->except(['destroy']);
    Route::get('/usuarios-delete/{usuario}', [UsuarioController::class, 'delete'])->name('usuarios.delete');
});