<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testGetEnv(){
        $belajar = env('BELAJAR', 'Programmer Zaman Now');
        self::assertEquals('Programmer Zaman Now', $belajar);
    }
    public function testDefaultEnv(){
        $author = env('AUTHOR', 'IMRON');
        self::assertEquals('IMRON', $author);
    }
    // memanggil Env dari .env
    public function testDefaultEnvKhusus(){
        $author = Env::get('AUTHOR','IMRON');
        self::assertEquals('IMRON', $author);
    }
}
