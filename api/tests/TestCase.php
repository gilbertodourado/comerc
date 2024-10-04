<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    // Método createApplication deve ser público
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php'; // Ajuste o caminho se necessário
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Executa as migrations para o banco de dados de testes
        Artisan::call('migrate');
    }

    protected function tearDown(): void
    {
        // Opcional: Você pode rodar as rollbacks das migrations após os testes, se necessário.
        Artisan::call('migrate:rollback');

        parent::tearDown();
    }
}
