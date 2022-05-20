<?php

namespace Tests\Feature;

use App\Data\foo;
use App\Data\bar;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Faker\Extension\BarcodeExtension;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

/*
|--------------------------------------------------------------------------
| Latihan ServiceContainer
|--------------------------------------------------------------------------
| Sebelumnya kita sudah mencoba melakukan Dependency Injection secara manual
| Laravel memiliki fitur Dependency Injection secara otomatis, dan ini wajib dikuasai agar lebih mudah membuat aplikasi 
| menggunakan Laravel. Di Laravel fitur ini bernama Service Container,
| dimana Service Container ini merupakan fitur yang digunakan untuk manajemen dependencies dan juga dependency injection
| Service Container di Laravel direpresentasikan dalam class bernama Application
| Kita tidak perlu membuat class Application secara manual, karena semua sudah dilakukan secara otomatis oleh framework Laravel
| Di semua project Laravel, hampir disemua bagian terdapat field $app yang merupakan instance dari Application
| https://laravel.com/api/9.x/Illuminate/Foundation/Application.html 
| Dengan menggunakan Service Container, kita tidak perlu membuat object secara manual lagi menggunakan kata kunci new
| Kita bisa menggunakan function make(key) yang terdapat di class Application untuk membuat dependency secara otomatis
| Saat kita menggunakan make(key), object akan selalu dibuat baru, jadi harap hati-hati ketika menggunakannya,
| karena dia bukan menggunakan object yang sama
*/
class ServiceContainerTest extends TestCase
{   
    public function testCreateDependency()
    {
        $foo1 = $this->app->make(foo::class); // new foo() (sederhana, 1 isian)
        $foo2 = $this->app->make(foo::class); // new foo() (sederhana, 1 isian)
        // seakan akan kita membuat new foo sama seperti $foo = new foo();
        self::assertEquals('foo', $foo1->foo());
        self::assertEquals('foo', $foo2->foo());
        // akan menghasilkan hasil nilai yg berbeda, padahal sama
        // self::assertNotSame($foo1, $foo2);
    }
/*
|--------------------------------------------------------------------------
| Mengubah Cara Membuat Dependency
|--------------------------------------------------------------------------
| 
| Saat kita menggunakan function make(key), secara otomatis Laravel akan membuat object,  
| namun kadang kita ingin menentukan cara pembuatan objectnya. Pada kasus seperti ini, 
| kita bisa menggunakan method bind(key, closure). Kita cukup return kan data yang
| kita inginkan pada function closure nya Saat kita menggunakan make(key) untuk mengambil dependencynya,
| secara otomatis function closure akan dipanggil. Perlu diingat juga, setiap kita memanggil make(key),
| maka function closure akan selalu dipanggil, jadi bukan menggunakan object yang sama
*/ 
    public function testBindInjection(){
        // $person = $this->app->make(person::class); // new Person() (akan gagal krn isi lebih dr 1)
        // self::assertNotNull($person); // cek apakah ada data (gagal krn tidak bisa terpanggil)
        // kalaw gitu kita harus inisiasi agar laravel tahu kita akan memanggil objek binding

        $this->app->bind(Person::class, function ($app){
            return new Person("Muhammad", "Al Imron");
        });
        $person1 = $this->app->make(Person::class); // closure() // new Person("Muhammad", "Al Imron"); alias baru
        $person2 = $this->app->make(Person::class); // closure() // new Person("Muhammad", "Al Imron"); alias baru (tidak sama dengan person 1)

        self::assertEquals('Muhammad', $person1->firstName);
        self::assertEquals('Muhammad', $person2->firstName);
        self::assertNotSame($person1, $person2);
    }

/*
|--------------------------------------------------------------------------
| Singelton
|--------------------------------------------------------------------------
| umnya ketika menggunakan make(key), maka secara default Laravel akan membuat object baru, 
| atau jika menggunakan bind(key, closure), function closure akan selalu dipanggil
| Kadang ada kebutuhan kita membuat object singleton, yaitu satu object saja, dan ketika butuh, kita cukup menggunakan object yang sama
| Pada kasus ini, kita bisa menggunakan function singleton(key, closure), maka secara otomatis ketika kita menggunakan make(key), maka object hanya dibuat di awal, selanjutnya object yang sama akan digunakan terus menerus ketika kita memanggil make(key)
| 
*/
    public function testSingleton(){
        $this->app->singleton(Person::class, function ($app){
            return new Person("Muhammad", "Al Imron");
        });
        $person1 = $this->app->make(Person::class); // new Person("Muhammad","Al Imron"); if not exists
        $person2 = $this->app->make(Person::class); // kemabalikan nilai yang sama (return existing)
        // kelebihan singleton ini tidak memakan memory yang banyak, krn satu objek sama di pakai berulang

        self::assertEquals('Muhammad', $person1->firstName);
        self::assertEquals('Muhammad', $person2->firstName);
        self::assertSame($person1, $person2);
    }
/*
|--------------------------------------------------------------------------
| Instance
|--------------------------------------------------------------------------
| Selain menggunakan function singleton(key, closure), untuk membuat singleton object, kita juga bisa menggunakan 
| object yang sudah ada, dengan cara menggunakan function instance(key, object)
| Ketika menggunakan make(key), maka instance object tersebut akan dikembalikan

*/
    public function testInstance(){
        $person = new Person("Muhammad", "Al Imron");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); //$person
        $person2 = $this->app->make(Person::class); //$person
        $person3 = $this->app->make(Person::class); //$person
        $person4 = $this->app->make(Person::class); //$person

        self::assertEquals('Muhammad', $person1->firstName);
        self::assertEquals('Muhammad', $person2->firstName);
        self::assertEquals('Muhammad', $person3->firstName);
        self::assertEquals('Muhammad', $person4->firstName);
    }
/*
|--------------------------------------------------------------------------
| Menggunakan Dependency Injection
|--------------------------------------------------------------------------
| Sekarang kita tahu bagaimana cara membuat dependency dan juga mendapatkan dependency di Laravel, sekarang bagaimana caranya 
| melakukan dependency injection? Secara default, jika kita membuat object menggunakan make(key), lalu Laravel mendeteksi 
| terdapat constructor, maka Laravel akan mencoba menggunakan dependency yang sesuai 
| dengan tipe yang dibutuhkan di Laravel
|
*/
    public function testDependencyInjection(){
        // apabila kita langsung ambil data, maka data tdk akan sama meski sama krn tidak di dalam service container
        // tanpa manual tanpa $bar = new bar($foo);
        $foo = $this->app->make(foo::class);
        $bar = $this->app->make(bar::class);
        // self::assertNotSame($foo, $bar->foo); //notsame = tidak sama
        // apabila kita menggunakan singleton data sama akan sama krn di dalam service container
        // tanpa manual tanpa $bar = new bar($foo);
        $this->app->singleton(foo::class, function($app){
            return new Foo();
        });
        $foo = $this->app->make(foo::class);
        $bar = $this->app->make(bar::class);
        // self::assertySame($foo, $bar->foo); // sama
        // tapi bila didalam dependency yang memiliki lebih dr 2 objek
        // maka bila di bandingkan langsung hasil tidak sama
        $this->app->singleton(foo::class, function($app){
            return new Foo();
        });
        $foo = $this->app->make(foo::class);
        $bar1 = $this->app->make(bar::class);
        $bar2 = $this->app->make(bar::class);
        // self::assertNotSame($bar1, $bar2); //notsame = tidak sama
        // perbaikannya seperti ini
        $this->app->singleton(bar::class, function($app){
            $foo = $app->make(foo::class);
            return new bar($foo);
        });
        $this->app->singleton(foo::class, function($app){
            return new foo();
        });
        $foo = $this->app->make(foo::class);
        $bar1 = $this->app->make(bar::class);
        $bar2 = $this->app->make(bar::class);
        // self::assertSame($bar1, $bar2); //hasil sama
    }

    public function testInterfaceToClass(){
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $this->app->singleton(HelloService::class, function($app){
           return new HelloServiceIndonesia(); 
        });

        $helloService = $this->app->make(HelloService::class);
        self::assertEquals("Halo guys Imron", $helloService->hello("Imron"));

    }
}
