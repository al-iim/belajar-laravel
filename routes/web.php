<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| App->Providers->RouteServiceProvider
| Jangan Lupa Menggunakan Routegroup
|
*/
/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Routing adalah proses menerima HTTP Request dan menjalankan kode sesuai dengan URL yang diminta. Routing biasanya tergantung 
| dari HTTP Method dan URL. Salah satu Service Provider yang paling penting di Laravel adakah RouteServiceProvider. 
| RouteServiceProvider bertanggung jawab untuk melakukan load data routing dari folder routes. Jika kita hapus Service Provider 
| ini, secara otomatis proses routing tidak akan berjalan. RouteServiceProvider secara default akan me-load data 
| routing dari folder routes.
|
*/
/*
|--------------------------------------------------------------------------
| Basic Routes 
|--------------------------------------------------------------------------
| Salah satu contoh routing yang paling sederhana adalah menggunakan path dan juga closure function sebagai handler nya
| Kita bisa menggunakan Facades Route, lalu menggunakan function sesuai dengan HTTP Method nya, misal
| Route::get($uri, $callback);
| Route::post($uri, $callback);
| Route::put($uri, $callback);
| Route::patch($uri, $callback);
| Route::delete($uri, $callback);
| Route::options($uri, $callback);
|
*/
Route::get('/', function () {
    return view('about');
});
Route::get('/pzn', function(){
    return "Hai Im";
});
/*
|--------------------------------------------------------------------------
| Redirect 
|--------------------------------------------------------------------------
| Router juga bisa digunakan untuk melakukan redirect dari satu halaman ke halaman lain. 
| Kita bisa menggunakan function Route::redirect(from, to)
|
*/
Route::redirect('/youtube', '/pzn');
/*
|--------------------------------------------------------------------------
| php artisan route:list 
|--------------------------------------------------------------------------
| Kadang kita ada kebutuhan melihat semua Routing yang ada di aplikasi Laravel kita. Untuk melihatnya, 
| kita bisa memanfaatkan file artisan dengan perintah : php artisan route:list
|
*/
/*
|--------------------------------------------------------------------------
| Fallback Route 
|--------------------------------------------------------------------------
| Apa yang terjadi jika kita melakukan request ke halaman yang tidak ada di aplikasi Laravel kita? Secara otomatis akan 
| mengembalikan error 404. Kadang-kadang kita ingin mengubah tampilan halaman error ketika halaman yang diakses tidak ada
| Pada kasus seperti ini, kita bisa membuat fallback route, yaitu callback yang akan dieksekusi ketika tidak ada route yang 
| cocok dengan halaman yang diakses. Kita bisa menggunakan function Route::fallback(closure)
|
*/
Route::fallback(function(){
    return "Cie, Halaman tidak ada";
});
// belajar view
Route::view('/hello', 'hello', ['name' => 'Muzammil Nadhif Abqory']);

Route::get('/hello-again', function (){
    return view('hello', ['name' => 'Alanna Nahwa Almahyra']);
});
Route::get('/hello-world', function (){
    return view('jello.hello', ['name' => 'Rizka Aulia Rahma']);
});
/*
|--------------------------------------------------------------------------
| Route Parameter 
|--------------------------------------------------------------------------
| Kadang kita ingin mengirim parameter yang terdapat di bagian dari URL ketika membuat web. Contoh misal parameter untuk id 
| di URL /products/{productId}. Laravel mendukung route parameter, dimana kita bisa menambahkan parameter di route url, 
| dan secara otomatis kita bisa ambil data nya di closure function yang kita gunakan di Route. Untuk membuat route 
| parameter, kita bisa gunakan {nama}. Kita bisa menambah beberapa route parameter, asal namanya berbeda
| Data route parameter tersebut akan dikirim secara otomatis pada closure function parameters
|
*/
Route::get('/product/{id}', function($idProduknyaApa){
    return "produknya nomor $idProduknyaApa";
})->name('product.detail');
Route::get('/products/{productnya}/items/{itemsnya}', function($idProduk, $idItems){
    return "produknya nomor $idProduk serta item ke $idItems";
})->name('product.item.detail');

/*
| ->name('product.detail'); || ini disebut named route, kita bisa kasih tambahkan route lagi yang mengarah ke named route
*/
Route::get('/produk/{id}', function($idProduknyaApa){
    $link = route('product.detail', ['id' => $idProduknyaApa]);
    return "Link $link";
});
Route::get('/produk-redirek/{id}', function($idProduknyaApa){
    return redirect()->route('product.detail', ['id' => $idProduknyaApa]);
});
/*
|--------------------------------------------------------------------------
| Regular Expression Constraints 
|--------------------------------------------------------------------------
| Kadang ada kalanya kita ingin menggunakan Route Parameter, namun parameternya memiliki pola tertentu, misal parameternya \
| hanya boleh angka misalnya. Pada kasus seperti itu, kita bisa menambahkan regular expression di Route Parameter
| Caranya kita bisa gunakan function where() setelah pembuatan Route nya
|
*/
Route::get('/categorie/{id}', function($idCategorie){
    return "kategorinya $idCategorie";
// })->where('id', '[0-9]+')->where('id', 'xxx')->where dst;
})->where('id', '[0-9]+');
/*
|--------------------------------------------------------------------------
| Optional Route Parameter 
|--------------------------------------------------------------------------
| Laravel juga mendukung Route Parameter Optional, artinya parameter nya tidak wajib diisi. Untuk membuat sebuah route 
| parameter menjadi optional, kita bisa tambahkan ? (tanda tanya). Namun perlu diingat, jika kita menjadikan route 
| parameter nya optional, maka kita wajib menambahkan default value di closure function nya
|
*/
Route::get('/users/{id?}', function($userId = '404'){
    return "User dengan id $userId";
});
/*
|--------------------------------------------------------------------------
| Routing Conflict 
|--------------------------------------------------------------------------
| Saat membuat router dengan parameter, kadang terjadi conflict routing. Di Laravel jika terjadi conflict tidak akan 
| menyebabkan error, namun Laravel akan memprioritaskan router yang pertama kali dibuat
|
*/
Route::get('/conflict/{name}', function($name){
    return "Conflict Muzzammil Nadhif Abqory";
});

Route::get('/conflict/{name}', function($name){
    return "Conflict $name";
});
/*
|--------------------------------------------------------------------------
| Named Route 
|--------------------------------------------------------------------------
| Di Laravel, kita bisa menamai Route dengan sebuah nama. Hal ini bagus ketika kita misal nanti butuh mendapatkan informasi 
| tentang route tersebut, misal route url nya, atau melakukan redirect ke route. Dengan menambahkan nama di Route nya, 
| kita bisa menggunakan nama route saja, tanpa khawatir URL nya akan diubah. Untuk menambahkan nama di route, kita 
| cukup gunakan function name().
|
*/
