<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AppEnvironmentTest extends TestCase
{
    // mengecek status env saat ini
    // public function testAppEnvironment(){
    //     var_dump(App::environment());
    // }
    // mengecek pembenaran status env
    public function testAppEnvTrueSingle(){
        if(App::environment('testing')){
            self::assertTrue(true);
        }
    }
    // mengecek pembenaran status env
    public function testAppEnvTrueMulti(){
        if(App::environment('testing','local','dev','prod')){
            // kode program kita di sini
            self::assertTrue(true);
            // jika salah akan muncul kode This test did not perform any assertions  D:\xampp\xampp_8120\htdocs\belajar-laravel\tests\Feature\AppEnvironmentTest.php:23
        }
    }
}
