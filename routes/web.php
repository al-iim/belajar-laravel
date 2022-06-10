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
/*
|--------------------------------------------------------------------------
| Belajar Controller 
|--------------------------------------------------------------------------
| Setelah kita bikin controller dengan artisan, lalu kita tambahkan logic
| kita tambahkan route selanjutnya
*/
Route::get('/controller/hello/request', [\App\Http\Controllers\HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);
/*
|--------------------------------------------------------------------------
| Request Input 
|--------------------------------------------------------------------------
| Saat membuat aplikasi web, kita tahu bahwa dalam HTTP Request kita bisa mengirim data, baik itu melalui query parameter, 
| atau melalui body (misal dalam bentuk form). Biasanya kita menggunakan $_GET atau $_POST atau $_FILES, namun di Laravel, 
| kita bisa menggunakan object Request untuk mendapatkan input yang dikirim melalui HTTP Request
|
*/
/*
|--------------------------------------------------------------------------
| Mengambil Input 
|--------------------------------------------------------------------------
| Untuk mengambil input yang dikirim oleh user, tidak peduli apapun HTTP Method yang digunakan, dan dari mana asalnya, entah 
| dari body atau query parameter. Untuk mengambil input user, kita bisa gunakan method input(key, default) pada Request, 
| dimana jika key nya tidak ada, maka akan mengembalikan default value di parameter.
|
*/
Route::get('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
/*
|--------------------------------------------------------------------------
| Nested Input 
|--------------------------------------------------------------------------
| Salah satu fitur yang powerful di Laravel adalah, kita bisa mengambil input nested hanya dengan menggunakan titik
| Misal jika kita menggunakan $requet->input(‘name.first’), maka artinya itu mengambil key first di dalam name, 
| Ini cocok ketika kita kirim request dalam bentuk form atau json.
|
*/
Route::get('/input/hello/nested', [\App\Http\Controllers\InputController::class, 'helloFirst']);
Route::post('/input/hello/nested', [\App\Http\Controllers\InputController::class, 'helloFirst']);
/*
| untuk mengetes kodingan ini, kita harus mematikan fitur keamanan laravel : CSRF
| App/Http/Middleware/Kernel.php (non aktifkan line 37 : \App\Http\Middleware\VerifyCsrfToken::class,)
*/
/*
|--------------------------------------------------------------------------
| Mengambil Semua Input 
|--------------------------------------------------------------------------
| Untuk mengambil semua input yang terdapat di HTTP Request, baik itu dari query param ataupun body, kita bisa menggunakan 
| method input() tanpa parameter milik Request. Return value dari method input() ini adalah array
|
*/
Route::post('/input/hello/input', [\App\Http\Controllers\InputController::class, 'helloInput']);
/*
|--------------------------------------------------------------------------
| Mengambil Array Input (tertentu) 
|--------------------------------------------------------------------------
| Laravel juga memiliki kemampuan untuk mengambil value dari input berupa array
| Misal kita bisa gunakan $request->input(‘products.*.name’), artinya kita mengambil semua name yang ada di array products
|
*/
Route::post('/input/hello/array', [\App\Http\Controllers\InputController::class, 'arrayInput']);
/*
|--------------------------------------------------------------------------
| Input Query String 
|--------------------------------------------------------------------------
| Method input() digunakan untuk mengambil data di semua input, baik itu query param ataupun body
| Jika misal kita hanya butuh mengambil data di query param, kita bisa menggunakan method $request->query(key)
| Atau jika semua query dalam bentuk array, kita bisa gunakan $request->query() tanpa parameter key
|
*/
/*
|--------------------------------------------------------------------------
| Dynamic Properties 
|--------------------------------------------------------------------------
| Laravel juga mendukung Dynamic Properties yang secara otomatis akan mengambil key dari input Request
| Misal ketika kita menggunakan $request->first_name, jika dalam object Request tidak ada property dengan nama $first_name, 
| maka secara otomatis akan mengambil input dengan key first_name
|
*/
/*
|--------------------------------------------------------------------------
| Input Type 
|--------------------------------------------------------------------------
| Class Request di Laravel memiliki beberapa helper method yang digunakan untuk melakukan konversi input secara otomatis
| Ini bisa digunakan untuk mempermudah kita ketika ingin otomatis melakukan konversi input data ke tipe data yang kita inginkan
|--------------------------------------------------------------------------
| Boolean
| Untuk melakukan konversi tipe data input secara otomatis ke boolean, kita bisa gunakan method boolean(key, default) pada class Request
|--------------------------------------------------------------------------
| Date
| Untuk melakukan konversi tipe data ke Date secara otomatis, kita bisa gunakan method date(key, pattern, timezone) pada class Request
| Laravel menggunakan library Carbon untuk memanipulasi tipe data Date dan Time
| https://github.com/briannesbitt/Carbon 
|
*/
Route::post('/input/type', [\App\Http\Controllers\InputController::class, 'inputType']);
/*
|--------------------------------------------------------------------------
| Filter Request Input 
|--------------------------------------------------------------------------
| Kadang pada saat kita menerima input data dari user, kita ingin secara mudah menerima semua key input, lalu menyimpannya ke database 
| misalnya. Pada kasus seperti ini, kadang sangat berbahaya jika misal user secara tidak sengaja mengirim key yang salah, 
| lalu kita mencoba melakukan update key yang salah itu ke database. Untungnya Laravel memiliki helper method di class 
| Request untuk melakukan filter input
|
*/
/*
|--------------------------------------------------------------------------
| Method Filter Request Input 
|--------------------------------------------------------------------------
| $request->only([key1, key2]) digunakan untuk mengambil hanya input yang kita sebutkan di parameter
| $request->except([key1, key2]) digunakan untuk mengambil semua input, tapi tidak dengan yang kita sebutkan di parameter
|
*/
Route::post('/input/filter/only', [\App\Http\Controllers\InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [\App\Http\Controllers\InputController::class, 'filterExcept']);
/*
|--------------------------------------------------------------------------
| File Merge 
|--------------------------------------------------------------------------
| Kadang-kadang kita ingin menambahkan default input value ketika input tersebut tidak dikirim di request
| Kita bisa menggunakan method merge(array) untuk menambah input ke request, dan jika ada key yang sama, 
| otomatis akan diganti. Atau mergeIfMissing(array) untuk menambah input ke request, dan jika input dengan 
| key yang sama sudah ada, maka akan dibatalkan.
|
*/
Route::post('/input/filter/merge', [\App\Http\Controllers\InputController::class, 'filterMerge']);
/*
|--------------------------------------------------------------------------
| File Upload 
|--------------------------------------------------------------------------
| Laravel juga sudah menyediakan method file(key) di Request untuk mengambil request file upload
| Tipe data File Upload direpresentasikan dalam class Illuminate\Http\UploadedFile di Laravel
| https://laravel.com/api/9.x/Illuminate/Http/UploadedFile.html 
| File Upload di Laravel terintegrasi dengan baik dengan File Storage
|
*/
/*
| untuk mengupload lewat postman, harus di jalankan denga artisan serve
| di postman isi link sesuai alamat serve nya lalu pilih body dan pilih form-data
| lalu ganti text mennjadi file
|
| untuk akses langsung di web kita ketik http://127.0.0.1:8000/storage/pictures/Screenshot%202022-05-10%20122153.png
*/
Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload']);
/*
|--------------------------------------------------------------------------
| Response 
|--------------------------------------------------------------------------
| Sebelumnya kita sudah tahu di Route dan Controller, kita bisa mengembalikan data berupa string dan view
| Laravel memiliki class Illuminate\Http\Response, yang bisa digunakan untuk representasi dari HTTP Response
| Dengan class Response ini, kita bisa mengubah HTTP Response seperti Body, Header, Cookie, dan lain-lain
| Untuk membuat object response, kita bisa menggunakan function helper response(content, status, headers)
|
| jangan lupan | use Illuminate\Http\Response;
|
*/
Route::get('response/hello', [\App\Http\Controllers\ResponseController::class, 'response']);
/*
|--------------------------------------------------------------------------
| HTTP Response Header 
|--------------------------------------------------------------------------
| Saat kita membuat Response, kita bisa ubah status dan juga response header
| Kita bisa menggunakan function response(content, status, headers)
| Atau bisa menggunakan method withHeaders(arrayHeaders) dan header(key, value)
|
*/
Route::get('/response/header', [\App\Http\Controllers\ResponseController::class, 'header']);
/*
|--------------------------------------------------------------------------
| Response Type 
|--------------------------------------------------------------------------
| Sebelumnya kita sudah melakukan response JSON secara manual, sebenarnya Response sudah memiliki banyak sekali helper method 
| untuk beberapa jenis response type. Untuk menampilkan view, kita bisa menggunakan method view(name, data, status, headers)
| Untuk menampilkan JSON, kita bisa menggunakan method json(array, status, headers)
| Untuk menampilkan file, kita bisa menggunakan file(pathToFile, headers)
| Untuk menampilkan file download, kita bisa menggunakan method download(pathToFile, name, headers)
|
*/
Route::get('/response/type/view', [\App\Http\Controllers\ResponseController::class, 'ResponView']);
Route::get('/response/type/json', [\App\Http\Controllers\ResponseController::class, 'ResponJson']);
Route::get('/response/type/file', [\App\Http\Controllers\ResponseController::class, 'ResponFile']);
Route::get('/response/type/download', [\App\Http\Controllers\ResponseController::class, 'responDownload']);
/*
|--------------------------------------------------------------------------
| Cookie 
|--------------------------------------------------------------------------
| Saat kita membuat HTTP Response, kadang kita perlu membuat cookie. 
| Cookie adalah data yang otomatis dikirim ketika kita melakukan HTTP Request juga.
| Jadi kadang Cookie banyak digunakan untuk melakukan management session di aplikasi berbasis web.
|
*/
/*
|--------------------------------------------------------------------------
| Secure Cookie 
|--------------------------------------------------------------------------
| Secara default, cookie yang dibuat di Laravel akan selalu di enkripsi, dan ketika kita membaca cookie, secara otomatis akan di dekrip 
| Semua hal itu dilakukan otomatis oleh class App\Http\Middleware\EncryptCookies
| Jika misal kita tidak ingin melakukan enkripsi pada sebuah cookie, kita bisa mengubah property EncryptCookies yang bernama $except
|
*/
/*
|--------------------------------------------------------------------------
| Membuat Cookie 
|--------------------------------------------------------------------------
| Untuk membuat cookie, kita bisa gunakan method cookie(name, value, timeou, path, domain, secure, httpOnly) di object Response
|
*/
Route::get('/cookie/set', [\App\Http\Controllers\CookieController::class, 'createCookie']);
/*
|--------------------------------------------------------------------------
| Menerima Cookie 
|--------------------------------------------------------------------------
| Setelah membuat cookie di Response, secara otomatis Cookie akan disimpan di Browser sampai timeout atau expired
| Browser akan secara otomatis mengirim cookie tersebut ke domain dan path yang sudah ditentukan ketika kita membuat cookie
| Oleh karena itu, kita bisa menangkap data cookie tersebut di Response dengan method cookie(name, default) 
| Atau jika ingin mengambil semua cookies dalam array, kita bisa gunakan $request->cookies->all()
| 
*/
Route::get('/cookie/get', [\App\Http\Controllers\CookieController::class, 'getCookie']);
/*
|--------------------------------------------------------------------------
| Clear Cookie 
|--------------------------------------------------------------------------
| Tidak ada cara untuk menghapus cookie
| Namun jika kita ingin menghapus cookie, kita bisa membuat cookie dengan nama yang sama dengan value kosong, 
| dan waktu expired secepatnya. Di Laravel, hal ini bisa kita lakukan dengan menggunakan method withoutCookie(name)
|
*/
Route::get('/cookie/clear', [\App\Http\Controllers\CookieController::class, 'clearCookie']);
/*
|--------------------------------------------------------------------------
| Redirect 
|--------------------------------------------------------------------------
| Sebelumnya kita sudah bahas tentang redirect di materi Route, sekarang kita bahas lebih detail tentang redirect
| Redirect itu sendiri di Laravel direpresentasikan dalam response Illuminate\Http\RedirectResponse
| Untuk membuat object redirect, kita bisa menggunakan helper function redirect(to)
|
*/
Route::get('redirect/from', [\App\Http\Controllers\RedirectController::class, 'redirectFrom']);
Route::get('redirect/to', [\App\Http\Controllers\RedirectController::class, 'redirectTo']);
/*
|--------------------------------------------------------------------------
| Redirect to Named Routes 
|--------------------------------------------------------------------------
| Sebelumnya kita sudah tahu bahwa kita bisa menambahkan name di routes
| Laravel juga bisa melakukan redirect ke routes berdasarkan namanya, salah satu keuntungannya adalah 
| kita bisa menambahkan parameter tanpa harus manual membuat path nya
| Kita bisa menggunakan method route(name, params) di RedirectResponse
|
*/
Route::get('redirect/nama', [App\Http\Controllers\RedirectController::class, 'redirectName']);
Route::get('redirect/nama/{name}', [App\Http\Controllers\RedirectController::class, 'redirectHello'])
->name('redirect-hello');
/*
|--------------------------------------------------------------------------
| Redirect to Controller Action 
|--------------------------------------------------------------------------
| Selain menggunakan Named Routes, kita juga bisa melakukan redirect ke Controller Action
| Secara otomatis nanti Laravel akan mencari path yang sesuai dengan Controller Action tersebut
| Kita bisa menggunakan method action(controller, params) di RedirectResponse
|
*/
Route::get('redirect/action', [App\Http\Controllers\RedirectController::class, 'redirectAction']);
/*
|--------------------------------------------------------------------------
| Redirect to External Domain 
|--------------------------------------------------------------------------
| Secara default, redirect hanya dilakukan ke domain yang sama dengan lokasi domain aplikasi web Laravel nya
| Jika kita ingin melakukan redirect ke domain lain, kita bisa menggunakan method away(url) di RedirectResponse
|
*/