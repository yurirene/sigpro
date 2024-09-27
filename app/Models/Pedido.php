<?php

namespace App\Models;

use App\Traits\GenericTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use GenericTrait;

    protected $table = 'pedidos';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $casts = [
        'produtos' => 'array'
    ];
    protected $dates = ['created_at'];


}
