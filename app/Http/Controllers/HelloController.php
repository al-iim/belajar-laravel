<?php

namespace App\Http\Controllers;

use App\Services\HelloService;
use Illuminate\Http\Request;

class HelloController extends Controller
{
/*
|--------------------------------------------------------------------------
| Controller 
|--------------------------------------------------------------------------
| Membuat Route memang mudah, tapi jika kita harus menyimpan semua logic aplikasi kita di closure function Route, lama-lama akan 
| sulit untuk dilakukan. Di Laravel kita bisa menggunakan Controller sebagai tempat menyimpan logic dari Route, sehingga tidak 
| perlu kita lakukan lagi di Route. Controller direpresentasikan sebagai class, dan penamaan class nya selalu diakhiri dengan
| Controller, misal UserController, ProductController, CategoryController, dan lain-lain
|
*/
/*
|--------------------------------------------------------------------------
| Membuat Controller 
|--------------------------------------------------------------------------
| Untuk membuat Controller, kita bisa membuatnya di namespace App\Http\Controllers, dimana class Controller adalah class turunan 
| dari class Illuminate\Routing\Controller. Agar lebih mudah, kita bisa menggunakan file artisan untuk membuat controller, 
| caranya dengan menggunakan perintah : php artisan make:controller NamaController.
|
*/
/*
|--------------------------------------------------------------------------
| Membuat Function di Controller 
|--------------------------------------------------------------------------
| Sebagai pengganti closure function di Route, kita bisa membuat function di Controller, dan menaruh semua logic web kita di 
| function Controller. Selanjutnya, kita bisa meregistrasikan function Controller tersebut ke Route, dengan cara mengganti 
| parameter closure di route dengan array yang berisi class Controller dan juga function name nya.
|
*/
    // public function hello(): string
    // {
    //     return "Hello";
    // }
/*
|--------------------------------------------------------------------------
| Dependency Injection 
|--------------------------------------------------------------------------
| Controller mendukung Dependency Injection, pembuatan object Controller, sebenarnya dilakukan oleh Service Container
| Dengan demikian, kita bisa menambahkan dependency yang dibutuhkan di Constructor Controller, dan secara otomatis 
| Laravel akan mengambil dependency tersebut dari Service Container.
|
*/
/*
|--------------------------------------------------------------------------
| Kita inisiasi interface nya 
|--------------------------------------------------------------------------
| Apa itu PHP interface?
| Interface adalah sebuah class yang seluruh methodnya adalah abstract method, karena seluruh methodnya adalah abstract method 
| sehingga interface perlu diimplementasikan oleh child class.
| kita implementasikan interface di bawah
*/
    private HelloService $helloService;

/*
|--------------------------------------------------------------------------
| Apa peran dari constructor?
|--------------------------------------------------------------------------
| Constructor merupakan suatu method yang akan memberikan nilai awal pada saat suatu objek dibuat. Pada saat program dijalankan,
| constructor akan langsung memberikan nilai awal pada saat perintah new, membuat suatu objek.
| disini kita buat constructor nya :
|
*/
    public function __construct(HelloService $helloService)
    {
        $this->helloService = $helloService;
    }

    public function hello(string $name): string
    {
        return $this->helloService->hello($name);
    }
/*
|--------------------------------------------------------------------------
| Request 
|--------------------------------------------------------------------------
| Di PHP, biasanya ketika kita ingin mendapatkan detail dari request biasanya kita lakukan menggunakan global variable seperti 
| $_GET, $_POST, dan lain-lain
| Di Laravel, kita tidak perlu melakukan itu lagi, HTTP Request di bungkus dalam sebuah object dari class Illuminate\Http\Request
| Dan kita bisa menambahkan Request di parameter function di Router atau di Controller, dan secara otomatis nanti Laravel 
| akan melakukan dependency injection data Request tersebut
|
*/
    public function helloRequest(Request $request, $name): string
    {
        return $this->helloService->hello($name);
    }
/*
|--------------------------------------------------------------------------
| Request Path 
|--------------------------------------------------------------------------
| Object Request banyak memiliki method yang bisa kita gunakan untuk mendapatkan informasi Path dan URL
| $request->path() untuk mendapatkan path, misal http://example.com/foo/bar, akan mengembalikan foo/bar
| $request->url() untuk mendapat URL tanpa query parameter
| $request->fullUrl() untuk mendapatkan URL dengan query parameter
|
*/
/*
|--------------------------------------------------------------------------
| Request Method 
|--------------------------------------------------------------------------
| Request juga bisa digunakan untuk mendapatkan informasi HTTP Method
| $request->method() akan mengembalikan HTTP Method
| $request->isMethod(method) digunakan untuk mengecek apakah request memiliki HTTP method sesuai parameter atau tidak, 
| misal $request->isMethod(‘post’)
|
*/
/*
|--------------------------------------------------------------------------
| Lanjutan Request Method 
|--------------------------------------------------------------------------
| Untuk mendapatkan informasi HTTP Header, kita juga bisa menggunakan object Request
| $request->header(key) digunakan untuk mendapatkan data header dengan key parameter
| $request->header(key, default) digunakan untuk mendapatkan data header dengan key parameter, jika tidak ada maka akan 
| mengembalikan data default nya 
| $request->bearerToken() digunakan untuk mendapatkan informasi token Bearer yang terdapat di header Authorization, 
| dan secara otomatis menghapus prefix Bearer nya
|
*/
    public function request(Request $request): string
    {
        return  $request->path() . PHP_EOL .
                $request->url() . PHP_EOL .
                $request->fullUrl() . PHP_EOL .
                $request->method() . PHP_EOL .
                $request->header("Accept");

    }
}
