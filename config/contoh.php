<?php
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
