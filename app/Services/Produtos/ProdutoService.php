<?php

namespace App\Services\Produtos;

use App\Models\Produtos\ConsignacaoProduto;
use App\Models\Produtos\FluxoCaixa;
use App\Models\Produtos\Produto;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ProdutoService
{
    public static function store(array $request) : ?Produto
    {
        $valor = str_replace(',', '.', str_replace('.', '',$request['valor']));
        return Produto::create([
            'nome' => $request['nome'],
            'valor' => $valor,
            'estoque' => 0
        ]);
    }

    public static function update(Produto $produto, array $request) : ?Produto
    {
        $valor = str_replace(',', '.', str_replace('.', '',$request['valor']));
        $produto->update([
            'nome' => $request['nome'],
            'valor' => $valor
        ]);
        return $produto;
    }

    public static function delete(Produto $produto)
    {
        $produto->delete();
    }

    public static function getAllProdutos()
    {
        return Produto::all();
    }

    public static function getTotalizadoresProdutos()
    {
        $total_produtos = 0;
        $valor_produtos = 0;
        $total_consignado = 0;
        $valor_consignado = 0;
        $consignacao = ConsignacaoProduto::all();
        $produtos = Produto::all();

        $produtos->map(function($item) use (&$total_produtos) {
            $total_produtos += $item->estoque;
        });

        $produtos->map(function($item) use (&$valor_produtos) {
            $valor_produtos += $item->estoque * $item->valor;
        });



        $consignacao->map(function($item) use (&$total_consignado) {
            $total_consignado += $item->quantidade_consignada - $item->quantidade_retornada;
        });
        $consignacao->map(function($item) use (&$valor_consignado) {
            $quantidade = $item->quantidade_consignada - $item->quantidade_retornada;
            $valor_consignado += $quantidade * $item->produto->valor;
        });
        return [
            'total_produtos' => $total_produtos,
            'valor_produtos' => number_format($valor_produtos, 2, ',', '.'),
            'total_consignado' => $total_consignado,
            'valor_consignado' => number_format($valor_consignado, 2, ',', '.')
        ];
    }

    public static function getTotalizadores()
    {
        try {
            $mesAtual = Carbon::today();
            $mesAnterior = Carbon::today()->subYear();
            $periodos = CarbonPeriod::create($mesAnterior, '1 month', $mesAtual);
            $meses = [];
            foreach ($periodos as $periodo) {
                $inicio = $periodo->startOfMonth()->format('Y-m-d');
                $fim = $periodo->endOfMonth()->format('Y-m-d');
                $meses[$periodo->format('m-Y')] = FluxoCaixa::whereIn('tipo', [FluxoCaixa::ENTRADA, FluxoCaixa::SAIDA])
                    ->whereBetween('data_lancamento', [$inicio, $fim])
                    ->get();
            }
            $retorno = [];
            $saldoInicial = FluxoCaixa::where('tipo', FluxoCaixa::SALDO_INICIAL)->first();
            $total = !is_null($saldoInicial) ? $saldoInicial->getRawOriginal('valor') : 0;
            foreach ($meses as $key => $lancamentos) {
                foreach ($lancamentos as $lancamento) {
                    if ($lancamento->tipo == FluxoCaixa::ENTRADA) {
                        $total += $lancamento->getRawOriginal('valor');
                    } else {
                        $total -= $lancamento->getRawOriginal('valor');
                    }
                }
                $retorno[$key] = $total;
            }
            return $retorno;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
