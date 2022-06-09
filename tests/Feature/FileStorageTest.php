<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
/*
|--------------------------------------------------------------------------
| File Storage 
|--------------------------------------------------------------------------
| Laravel mendukung abstraction untuk management File Storage menggunakan library Flysystem
| Dengan menggunakan fitur File Storage ini, kita bisa menyimpan file ke dalam File Storage dan mengubah target dari File Storage tersebut
| Misal kita bisa simpan file ke Local tempat terinstall aplikasi Laravel kita, atau bahkan kita bisa simpan file kita di Amazon S3
| https://github.com/thephpleague/flysystem 
|
*/
/*
|--------------------------------------------------------------------------
| Konfigurasi File Storage 
|--------------------------------------------------------------------------
| Konfigurasi file storage di Laravel terdapat di file config/filesystems.php
| Kita bisa menambahkan banyak konfigurasi File Storage, dan nanti ketika kita akan menyimpan file, kita bisa 
| menentukan File Storage mana yang akan digunakan
|
*/
/*
|--------------------------------------------------------------------------
| FileSystem 
|--------------------------------------------------------------------------
| Implementasi tiap File Storage di Laravel adalah sebuah interface bernama FileSystem
| https://laravel.com/api/9.x/Illuminate/Contracts/Filesystem/Filesystem.html 
| Dan untuk mendapatkan storage, kita bisa gunakan Facade Storage::disk(namaFileStorage)
| https://laravel.com/api/9.x/Illuminate/Support/Facades/Storage.html 
|
*/
     public function testStorage()
    {
        /*
        | Jangan lupa tambahkan | use Illuminate\Support\Facades\Storage;
        */
        $filesystem = Storage::disk("local");
        $filesystem->put("file.txt", "alanna nahwa almahyra");

        self::assertEquals("alanna nahwa almahyra", $filesystem->get("file.txt"));
    }
/*
|--------------------------------------------------------------------------
| Storage Link 
|--------------------------------------------------------------------------
| Secara default, File Storage disimpan di folder /storage/app
| Laravel memiliki fitur bernama Storage Link, dimana kita bisa membuat link dari /storage/app/public ke /public/storage
| Dengan ini maka file yang terdapat di File Storage Public bisa diakses via web
| Untuk membuat link nya, kita bisa gunakan perintah : php artisan storage:link
|
*/
public function testPublic()
{
    /*
    | Jangan lupa tambahkan | use Illuminate\Support\Facades\Storage;
    */
    $filesystem = Storage::disk("public");
    $filesystem->put("file.txt", "mami");

    self::assertEquals("mami", $filesystem->get("file.txt"));
}
}
