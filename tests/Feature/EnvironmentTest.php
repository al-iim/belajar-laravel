<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;
/*
|--------------------------------------------------------------------------
| Latihan 
|--------------------------------------------------------------------------
| Saat kita membuat aplikasi, kadang kita perlu menyimpan nilai konfigurasi di environment variable
| Laravel memiliki fitur untuk memudahkan kita mengambil data dari environment variable
| Kita bisa menggunakan function env(key) atau Env::get(key) untuk mendapatkan nilai dari environment variable
| Internal implementasi dari Environment variable di Laravel menggunakan library https://github.com/vlucas/phpdotenv
|
*/
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

/*
|--------------------------------------------------------------------------
| Latihan 
|--------------------------------------------------------------------------
| Selain membaca dari environment variable, Laravel juga memiliki kemampuan untuk membaca nilai dari file .env yang 
| terdapat di project Laravel. Ini lebih mudah dibandingkan mengubah environment variable di sistem operasi
| Kita cukup menambah environment variable ke file .env. File .env secara default di ignore
| di Git project Laravel, oleh karena itu, kita bisa menambahkan konfigurasi
| di local tanpa takut ter-commit ke Git Repository
*/
    // memanggil Env dari .env
    public function testDefaultEnvKhusus(){
        $author = Env::get('AUTHOR','IMRON');
        self::assertEquals('IMRON', $author);
    }
}
