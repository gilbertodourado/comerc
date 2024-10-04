<?php

namespace Tests;

class ExampleTest extends TestCase
{
    /**
     * Cria a aplicação para os testes.
     *
     * @return \Illuminate\Foundation\Application
     */
    protected function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php'; // Ajuste o caminho conforme necessário
    }

    public function testExample()
    {
        $this->assertTrue(true);
    }
}
