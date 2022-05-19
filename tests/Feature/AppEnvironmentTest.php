<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;
/*
|--------------------------------------------------------------------------
| Latihan Aplication Environment
|--------------------------------------------------------------------------
| Saat membuat aplikasi, kadang kita ingin menentukan saat ini sedang berjalan di environment mana, misal di local,
| di dev, di staging, di qa atau di production. Di Laravel, hal ini biasanya dilakukan dengan menggunakan
| environment variable APP_ENV. Dan untuk mengecek saat ini sedang berjalan di environment apa,
| kita bisa menggunakan function App::environment(value) atau
| App::environment([value1, value2]), dimana akan return true jika benar
*/
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
