<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
/*
|--------------------------------------------------------------------------
| Latihan Configuration
|--------------------------------------------------------------------------
| Untuk mengambil konfigurasi di file konfigurasi, kita bisa menggunakan function config(key, default) Dimana
| pembuatan key pada config diawali dengan nama file, lalu diikuti dengan key yang terdapat di dalam return value nya
| Tiap nested array menggunakan . (titik) Misal contoh.author.first, artinya kita ambil konfigurasi dari file contoh.php, 
| lalu ambil data array key author, dan di dalamnya kita ambil data key first. 
| Sama seperti function env(), function config() juga memiliki parameter default value jika key konfigurasinya tidak tersedia
*/
class ConfigurationTest extends TestCase
{
   public function testConfig(){
       $firstname = config('contoh.author.first');
       $lastname = config('contoh.author.last');
       $web = config('contoh.web');
       $email = config('contoh.email');

       self::assertEquals('al imron', $firstname);
       self::assertEquals('muhammad', $lastname);
       self::assertEquals('belajar-laravel.com', $web);
       self::assertEquals('muhammad.al.imron@um.ac.id', $email);
   }
}

/*
|--------------------------------------------------------------------------
| Membuat Cache Configurations
|--------------------------------------------------------------------------
| Saat kita membuat terlalu banyak file konfigurasi, lama-lama maka akan membuat proses baca konfigurasi menjadi lambat 
| karena Laravel harus membaca file setiap kali kita mengambil konfigurasi. Pada saat proses development, hal ini
| mungkin bukan masalah, namun jika sudah masuk ke production, maka ini bisa memperlambat performa aplikasi
| Laravel kita. Laravel memiliki fitur untuk meng-cache data konfigurasi yang kita buat menjadi satu file 
| sehingga proses membacanya lebih cepat karena datanya langsung di load saat aplikasi berjalan
| Untuk membuat configuration cache, kita bisa gunakan perintah : php artisan config:cache
|
*/
/*
|--------------------------------------------------------------------------
| Menghapus Cache Configurations
|--------------------------------------------------------------------------
| Ketika file cache sudah dibuat, jika kita menambah konfigurasi di file php yang terdapat di folder config,
| maka config tersebut tidak akan bisa diakses. Hal ini karena Laravel akan selalu menggunakan configuration
| cache jika ada, oleh karena itu kita bisa buat ulang cache nya, atau jika ingin menghapus cache nya,
| kita bisa gunakan perintah : php artisan config:clear
|
*/
