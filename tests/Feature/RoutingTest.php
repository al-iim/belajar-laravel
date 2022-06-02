<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/pzn')
        ->assertStatus(200)
        ->assertSeeText('Hai Im');
    }

    public function testRedirect()
    {
        $this->get('/youtube')
        ->assertRedirect('/pzn');
    }
    public function testFallback()
    {
        $this->get('/tidakada')
        ->assertSeeText('Cie, Halaman tidak ada');
    }
    public function testRouteParameter(){
        $this->get('/product/1')
        ->assertSeeText('produknya nomor 1');

        $this->get('/products/1/items/2')
        ->assertSeeText('produknya nomor 1 serta item ke 2');
    }
    public function testRouteParameterRegex()
    {
        $this->get('/categorie/1')
        ->assertSeeText('kategorinya 1');
        $this->get('/categorie/im')
        ->assertSeeText('Cie, Halaman tidak ada');
    }
    public function testOptionalParameter(){
        $this->get('/users/')
        ->assertSeeText('User dengan id 404');
    }
    public function testConflict(){
        $this->get('conflict/im')
        ->assertSeeText('Conflict im');
    }
    public function testNamedRoute(){
        // $this->get('/produk/1')
        // ->assertSeeText('Link http://belajar-laravel.test/product/1');
        $this->get('/produk-redirek/1')
        ->assertRedirect('/product/1');

    }
}
