<?php

namespace App\Services\Produtos;

use App\Models\Produtos\ConsignacaoProduto;
use App\Models\User;

class ConsignacaoProdutoService
{

    public static function store(array $request) : ?ConsignacaoProduto
    {
        try {
            return ConsignacaoProduto::create([
                'quantidade_consignada' => $request['quantidade_consignada'],
                'quantidade_retornada' => 0,
                'produto_id' => $request['produto_id'],
                'user_id' => $request['user_id'],
            ]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function update(ConsignacaoProduto $estoque, array $request) : ?ConsignacaoProduto
    {
        try {
            $estoque->update([
                'quantidade_consignada' => $request['quantidade_consignada'],
                'quantidade_retornada' => $request['quantidade_retornada'],
                'produto_id' => $request['produto_id'],
                'user_id' => $request['user_id'],
            ]);

            return $estoque;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function delete(ConsignacaoProduto $estoque) : void
    {
        try {
            $estoque->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getUsuarios() : array
    {
        return User::whereHas('roles', function ($sql) {
            return $sql->whereIn('name', [
                'diretoria',
                'executiva',
                'secretaria_eventos',
                'secretaria_produtos',
                'secretaria_evangelismo',
                'secretaria_responsabilidade',
                'secretaria_comunicacao',
                'secretaria_estatistica',
                'secretaria_educacao_crista',
            ]);
        })
        ->get()
        ->pluck('name', 'id')
        ->toArray();
    }
}
