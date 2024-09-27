<?php

namespace App\Models\Produtos;

use App\Models\User;
use App\Traits\GenericTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsignacaoProduto extends Model
{
    use GenericTrait;

    protected $table = 'consignacao_produtos';
    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
