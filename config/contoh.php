<?php

/*
|--------------------------------------------------------------------------
| Latihan Configuration
|--------------------------------------------------------------------------
| Environment variable cocok digunakan untuk jenis konfigurasi yang memang butuh berubah-ubah nilainya,
| dan terintegrasi dengan baik dengan environment variable di sistem operasi Laravel juga
| mendukung penulisan konfigurasi dengan menggunakan PHP Code, konfigurasi ini
| biasanya digunakan ketika memang dibutuhkan tidak terlalu sering berubah, 
| dan biasanya pengaturannya hampir sama untuk tiap lokasi dijalankan aplikasi
| Namun saat menggunakan fitur Laravel Configuration, kita juga tetap bisa mengakses Environment Variable
|
*/
return [
    "author" => [
        // bisa di ketik langsung atau ambil dari environment dan apabila kosong ambil string selanjutnya
        // "first" => 'al imron',
        // "last" => 'muhammad'
        "first" => env('NAME_FIRST', 'al imron'),
        "last" => env('NAME_LAST', 'muhammad')
    ],
    "web" => 'belajar-laravel.com',
    "email" => 'muhammad.al.imron@um.ac.id'
];
// untuk mengambil nilai first author kita bisa memberikan perintah contoh.author.first
