<?php

namespace Tests\Feature;

use App\Data\bar;
use App\Data\foo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DependencyInjectionTest extends TestCase
{
    // Di dalam pengembangan perangkat lunak, ada konsep yang namanya Dependency Injection
    // Dependency Injection adalah teknik dimana sebuah object menerima object lain yang dibutuhka atau istilahnya dependencies
    // Saat kita membuat object, sering sekali kita membuat object yang butuh object lain
    // https://en.wikipedia.org/wiki/Dependency_injection 

    public function testDependencyInjection(){
        $foo = new foo();
        $bar = new bar($foo);

        self::assertEquals('foo and bar', $bar->bar());
    }
}
