<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'order_id', // Adicione esta linha
        'product_id', // Outros atributos que você já deve ter
        'quantity',
        'price',
    ];

    // Define o nome da tabela
    protected $table = 'order_product';

    // Se necessário, defina também a chave primária
    protected $primaryKey = 'id'; // ou outro nome da chave primária

    // Se você não está usando timestamps, adicione
    public $timestamps = true; // ou false, se não usar created_at/updated_at
}
