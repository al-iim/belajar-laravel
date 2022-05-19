<?php

namespace Tests\Feature;

use App\Data\bar;
use App\Data\foo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
/*
|--------------------------------------------------------------------------
| Latihan Dependency Injection
|--------------------------------------------------------------------------
| Di dalam pengembangan perangkat lunak, ada konsep yang namanya Dependency Injection
| Dependency Injection adalah teknik dimana sebuah object menerima object lain yang dibutuhkan atau istilahnya dependencies
| Saat kita membuat object, sering sekali kita membuat object yang butuh object lain
| https://en.wikipedia.org/wiki/Dependency_injection 
*/
class DependencyInjectionTest extends TestCase
{
    public function testDependencyInjection(){
        $foo = new foo();
        $bar = new bar($foo);

        self::assertEquals('foo and bar', $bar->bar());
    }
}
