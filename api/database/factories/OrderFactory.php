<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define o estado padrão do modelo.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => Client::factory(), // Cria um cliente usando o factory de Client
            'created_at' => Carbon::now(), // Use Carbon para obter a data atual
            'updated_at' => Carbon::now(), // Use Carbon para obter a data atual
        ];
    }
}
