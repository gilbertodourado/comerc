<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    // Atributos que podem ser atribuídos em massa
    protected $fillable = [
        'name',
        'email',
        'phone',
        'birth_date',
        'address',
        'complement',
        'neighborhood',
        'zip_code',
    ];

    // Relacionamento com a tabela Orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
