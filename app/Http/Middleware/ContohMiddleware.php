<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContohMiddleware
{
/*
|--------------------------------------------------------------------------
| Middleware 
|--------------------------------------------------------------------------
| Middleware merupakan cara untuk melakukan filtering terhadap HTTP Request yang masuk ke aplikasi kita
| Laravel banyak sekali menggunakan middleware, contohnya melakukan enkripsi cookie, verifikasi CSRF, authentication dan lain-lain
| Semua middleware biasanya disimpan di folder app/Http/Middleware
|
*/
/*
|--------------------------------------------------------------------------
| Alur 
|--------------------------------------------------------------------------
| User -> request -> middleware -> controller
| dari controller -> middleware -> response -> user
|
| bisa juga masuk lebih dari 1 middleware
| User -> request -> middleware -> middleware -> middleware -> controller
| dari controller -> middleware -> middleware -> middleware -> response -> user
|
*/
/*
|--------------------------------------------------------------------------
| Membuat Middleware 
|--------------------------------------------------------------------------
| Untuk membuat middleware, kita bisa gunakan file artisan dengan perintah : 
| php artisan make:middleware NamaMiddleware (atau bikin shorcut ctrl + m , ctrl + w)
| jangan lupa regristasikan ke dalam Kernel.php middleware yg telah kita buat
| Middleware mendukung dependency injection, jadi kita bisa menambahkan dependency yang kita butuhkan di constructor jika memang mau
| Middleware sebenarnya sebuah class sederhana, hanya memiliki method handle(request, closure) yang akan dipanggil sebelum request 
| masuk ke controller kita
| Jika kita ingin meneruskan ke controller, kita bisa panggil closure(), sedangkan jika tidak, kita bisa melakukan manipulasi apapun 
| itu di middleware
| Method handle() di middleware bisa mengembalikan Response
|
*/
/*
|--------------------------------------------------------------------------
| Global Middleware 
|--------------------------------------------------------------------------
| Secara default, middleware tidak akan dieksekusi oleh Laravel, kita perlu meregistrasikan middleware nya terlebih dahulu ke aplikasi 
| kita. Kita bisa meregistrasikan middleware dengan beberapa cara
| Pertama kita bisa registrasikan middleware secara global
| Global, artinya middleware akan dieksekusi di semua route, ini kita bisa registrasikan di field $middleware di Kernel
|
*/
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');
        if($apiKey == "PZN"){
            return $next($request);
        }else {
            return response('Access Denied', 401);
        }
    }
/*
|--------------------------------------------------------------------------
| Middleware Parameter 
|--------------------------------------------------------------------------
| Jika kita ingin menambahkan dependency di middleware, kita bisa manfaatkan dependency injection di Laravel, namun bagaimana jika 
| kita hanya ingin mengirimkan parameter sederhana saja?. Kita bisa lakukan itu di handle() method, cukup tambahkan parameter tambahan
| setelah $next parameter, dan kita bisa kirim parameter tersebut ketika memanggil middleware nya dengan menggunakan : (titik dua), 
| lalu jika ada lebih dari satu parameter, gunakan koma sebagai pemisahnya
*/
    public function handleParameter(Request $request, Closure $next, string $key, int $status)
    {
        $apiKey = $request->header('X-API-KEY');
        if($apiKey == $key){
            return $next($request);
        }else {
            return response('Access Denied', $status);
        }
    }
}
