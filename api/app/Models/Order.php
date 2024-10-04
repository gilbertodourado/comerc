<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
    ];

    // Definindo a relação com o modelo Product
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product'); // Supondo que a tabela de junção se chama 'order_product'
    }
}
