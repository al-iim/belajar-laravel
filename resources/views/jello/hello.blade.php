<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

{{-- |--------------------------------------------------------------------------
| Nested View
|--------------------------------------------------------------------------
| View juga bisa disimpan di dalam directory lagi di dalam directory views. Hal ini baik ketika kita sudah banyak membuat views, 
| dan ingin melakukan management file views. Namun ketika kita ingin mengambil views nya, kita perlu ganti menjadi titik, 
| tidak menggunakan / (slash). Misal jika kita buat views di folder admin/profile.blade.php, maka untuk mengaksesnya 
| kita gunakan admin.profile
| --}}

<body>
    <h1>Hello {{ $name }}</h1>
</body>

</html>
