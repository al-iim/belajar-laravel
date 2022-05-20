<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Data\foo;
use App\Data\bar;
use App\Services\HelloService;

class FooBarServiceProviderTest extends TestCase   
{
    public function testServiceProvider()
    {
        $foo1=$this->app->make(foo::class);
        $foo2=$this->app->make(foo::class);
        self::assertSame($foo1,$foo2);

        $bar1=$this->app->make(bar::class);
        $bar2=$this->app->make(bar::class);
        self::assertSame($bar1,$bar2);

        self::assertSame($foo1, $bar1->foo);
        self::assertSame($foo1, $bar1->foo);
        
    }
    public function testPropertySingleton(){
        $helloService1 = $this->app->make(HelloService::class);
        $helloService2 = $this->app->make(HelloService::class);

        self::assertSame($helloService1, $helloService2);
        self::assertEquals('Halo guys Imron', $helloService1->hello('Imron'));
    }
    public function testKosongan(){
        self::assertTrue(true);
    }
}
