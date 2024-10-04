<?php

namespace Tests;

use Laravel\Lumen\Testing\TestCase;

class ExampleTest extends TestCase
{
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php'; // Ajuste o caminho se necessário
    }

    public function testExample()
    {
        $this->assertTrue(true);
    }
}
