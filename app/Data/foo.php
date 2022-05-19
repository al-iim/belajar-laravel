<?php

namespace App\Data;
/*
|--------------------------------------------------------------------------
| Latihan Dependency Injection
|--------------------------------------------------------------------------
| Di dalam pengembangan perangkat lunak, ada konsep yang namanya Dependency Injection
| Dependency Injection adalah teknik dimana sebuah object menerima object lain yang dibutuhkan atau istilahnya dependencies
| Saat kita membuat object, sering sekali kita membuat object yang butuh object lain
| https://en.wikipedia.org/wiki/Dependency_injection 
*/
class foo{
    public function foo(): string {
        return "foo";
    }
}
