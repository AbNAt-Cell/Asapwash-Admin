<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $conn = DB::connection();
        if ($conn instanceof \Illuminate\Database\SQLiteConnection) {
            $pdo = $conn->getPdo();
            $pdo->sqliteCreateFunction('acos', 'acos', 1);
            $pdo->sqliteCreateFunction('cos', 'cos', 1);
            $pdo->sqliteCreateFunction('radians', 'deg2rad', 1);
            $pdo->sqliteCreateFunction('sin', 'sin', 1);
        }
    }
}
