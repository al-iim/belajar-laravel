<?php

namespace App\Providers;
use App\Data\foo;
use App\Data\bar;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
/*
|--------------------------------------------------------------------------
| Service Providers 
|--------------------------------------------------------------------------
| Sekarang kita sudah tahu untuk melakukan dependency injection di Laravel, sekarang pertanyaannya apakah ada best practice 
| dimana melakukan dependency injection tersebut?. Laravel menyediakan fitur bernama Service Provider, dari namanya kita
| tahu bahwa ini adalah penyedia service atau dependency. Di dalam Service Provider, biasanya kita melakukan registrasi 
| dependency di dalam Service Container. Bahkan semua proses bootstraping atau pembentukan object-object di framework 
| Laravel itu sendiri dilakukan di ServiceProvider, kita bisa lihat saat pertama kali membuat project Laravel, ada 
| banyak sekali file ServiceProvider di namespace App\Providers
|
*/
/*
|--------------------------------------------------------------------------
| Membuat Service Provider 
|--------------------------------------------------------------------------
| php artisan make:provider NamaServiceProvider
|
*/

/*
|--------------------------------------------------------------------------
|  
|--------------------------------------------------------------------------
| Secara default semua Service Provider akan di load oleh Laravel, baik itu kita butuhkan atau tidak. Laravel memiliki
| fitur bernama Deferred Provider, dimana kita bisa menandai sebuah Service Provider agar tidak di load jika tidak 
| dibutuhkan dependency nya Kita bisa menandai Service Provider kita dengan implement interface DeferrableProvider,
| lalu implement method provides() yang memberi tahu tipe dependency apa saja yang terdapat di Service Provider 
| ini. Dengan fitur ini, Service Provider hanya akan di load ketika memang dependency nya dibutuhkan
| Setiap ada request baru, maka Serive Provider yang sudah Deffered tidak akan 
| di load jika memang tidak dibutuhkan
*/

// kalau service provider biasa nulisnya gini :
// class FooBarServiceProvider extends ServiceProvider
// kalaw service provider yg cepat gini
// lalu tambahkan provides apa aja di bawah sendiri
class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{
/*
|--------------------------------------------------------------------------
| Maksud Register 
|--------------------------------------------------------------------------
| Jadi dengan register kita sudah yakin benar data ini mau kita dependency kan
| jadi tidak perlu singleton,bind atau yang lainnya, cukup make saja, data akan same / sama
*/
/*
|--------------------------------------------------------------------------
| Registrasi Service Provider 
|--------------------------------------------------------------------------
| Setelah kita membuat Service Provider, secara default Service Provider tidak diload oleh Laravel Untuk memberi tahu 
| Laravel jika kita ingin menambahkan Service Provider, kita perlu menambahkannya pada config di app.php, terdapat 
| key providers yang berisi class-class Service Provider yang akan dijalankan oleh Laravel
|
| karena awalnya kita bikin service provider biasa (disebut eager = di jalankan saat itu juga)
| maka kita harus bersihkan cache nya agar aplikasi dapat berjalan Deferrable (Dijalankan kalaw dibutuhkan)
| php artisan clear-compiled
|
*/
    public function register()
    {
        // echo "FooBarServiceProvider | ";
    // Binding manual
        $this->app->singleton(foo::class, function($app){
            return new foo();
        });
        $this->app->singleton(bar::class, function($app){
            return new bar($app->make(foo::class));
        });
    }
    // kalaw kasus sederhana memakai property
    /*
|--------------------------------------------------------------------------
| bindings & singletons Properties 
|--------------------------------------------------------------------------
| Jika kita hanya butuh melakukan binding sederhana, misal dari interface ke class, kita bisa menggunakan fitur binding 
| via properties di Service Provider Kita bisa tambahkan property bindings untuk membuat binding, atau Menggunakan 
| property singletons untuk membuat binding singleton
|
*/
    public array $singletons = [
        HelloService::class => HelloServiceIndonesia::class
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    public function provides(): array
    {
        return [HelloService::class, foo::class, bar::class];
    }
}
