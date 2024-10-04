<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products'; // Nome da tabela

    protected $fillable = [
        'name',
        'price',
        'description',
        'photo', // Supondo que você tenha um campo para a foto do produto
    ];

    protected $casts = [
        'price' => 'decimal:2', // Formata o preço como decimal com duas casas decimais
    ];

    /**
     * Se houver relacionamentos, adicione aqui.
     */
    // Exemplo: public function orders() { return $this->hasMany(Order::class); }
}
