<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
// penggunaan facade
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
/*
|--------------------------------------------------------------------------
| Facade 
|--------------------------------------------------------------------------
| Sebelumnya kita selalu berinteraksi dengan fitur-fitur Laravel menggunakan dependency injection Namun kadang ada ketika kita 
| tidak bisa mendapatkan object Application, misal kita membuat kode di class yang bukan bawaan fitur Laravel, pada kasus 
| seperti ini, Facades sangat membantu. Facades adalah class yang menyediakan static akses ke fitur di Service Container 
| atau Application. Laravel menyediakan banyak sekali class Facades, kita akan bahas secara bertahap. Semua class Facades 
| ada di namespace https://laravel.com/api/9.x/Illuminate/Support/Facades.html 
| 
| 
*/
/*
|--------------------------------------------------------------------------
| Kapan harus Menggunakan Facade
|--------------------------------------------------------------------------
| Selalu gunakan facades jika memang dibutuhkan saja, jika bisa dilakukan menggunakan dependency injection, selalu gunakan 
| dependency injection. Terlalu banyak menggunakan Facades akan membuat kita tidak sadar bahwa sebuah class banyak sekali 
| memiliki dependency, jika menggunakan dependency injection, kita bisa sadar dengan banyaknya parameter yang terdapat 
| di constructor
|
*/
/*
|--------------------------------------------------------------------------
| Facades vs Helper Function 
|--------------------------------------------------------------------------
| Di Laravel, selain Facades ada juga Helper Function, bedanya pada Helper Function, tidak dikumpulkan dalam class. Contohnya
| sebelum kita sudah menggunakan Helper Function bernama config() atau env(), itu adalah Helper function yang terdapat di Laravel.
| Penggunaan helper function sebenarnya lebih mudah, namun jika dibandingkan dengan Facades, maka penggunaan Facades akan lebih 
| mudah dimengerti secara code
|
*/

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $firstname1 = config('contoh.author.first');
        //ini versi cepat nya alias Facade
        $firstname2 = Config::get('contoh.author.first');

/*
|--------------------------------------------------------------------------
| Bagaimana Facades Bekerja? 
|--------------------------------------------------------------------------
| Facades sebenarnya adalah class yang menyediakan akses ke dalam dependency yang terdapat di Service Container. Semua class 
| Facades adalah turunan dari class Illuminate\Support\Facades\Facade. Class Facade memiliki sebuah method __callStatic() 
| yang digunakan sebagai magic method yang akan dipanggil ketika kita memanggil static method di Facade, dan akan meneruskan 
| secara otomatis ke dependency yang terdapat di Service Container
| Contoh Config::get() 
| sebenarnya akan melakukan pemanggilan method get() di dependency config di Service Container. Untuk nama dependency yang 
| terdapat di Container, kita bisa lihat di method getFacadeAccessor() di class Facade nya
|
*/

        //kalau versi lambatnya / manual nya seperti ini
        $config = $this->app->make('config');
        $firstname3 = $config->get('contoh.author.first');

        self::assertEquals($firstname1, $firstname2);
        self::assertEquals($firstname1, $firstname3);

        // var_dump(Config::all());
    }
/*
|--------------------------------------------------------------------------
| Facades Mock = tiruan
|--------------------------------------------------------------------------
| Salah satu kekurangan menggunakan static function biasanya sulit untuk di test, karena mocking static function sangat sulit. Namun untungnya, 
| di Laravel, sudah disediakan function untuk melakukan mocking di Facades, sehingga kita bisa mudah ketika implementasi unit test. Laravel 
| menggunakan library Mockery untuk melakukan Mocking Facades https://github.com/mockery/mockery 
|
*/

    public function testFacadeMock(){
        
        // Log::shouldReceive();
        // App::shouldReceive();
        // Crypt::shouldReceive();
        
        Config::shouldReceive('get')
        // parameter nya
        ->with('contoh.author.first')
        ->andReturn('Imron Muzammil Alanna Rizka');

        // kalaw kita ga mocking, hasilnya ga akan cocok, krn mocking digunakan kalaw kita ga tahu hasil dr keluaran aplikasi terserbut
        
        $firstname = Config::get('contoh.author.first');
        self::assertEquals($firstname, 'Imron Muzammil Alanna Rizka');
    }

/*
|--------------------------------------------------------------------------
| Daftar Facades 
|--------------------------------------------------------------------------
| Ada banyak Facades di Laravel, dan seperti dijelaskan sebelumnya, hampir semuanya banyak menggunakan dependency di Service Container
| Untuk lebih jelas tentang ada Facades apa saja, kita bisa lihat di sini : https://laravel.com/docs/9.x/facades#facade-class-reference 
|
*/
}
