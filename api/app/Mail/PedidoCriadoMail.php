<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PedidoCriadoMail extends Mailable
{
    use SerializesModels;

    public $pedido; // Supondo que você deseja passar um objeto de pedido para a view

    public function __construct($pedido)
    {
        $this->pedido = $pedido;
    }

    public function build()
    {
        return $this->view('emails.pedido_criado') // View para o e-mail
                    ->subject('Pedido Criado com Sucesso')
                    ->with([
                        'pedido' => $this->pedido,
                    ]);
    }
}
