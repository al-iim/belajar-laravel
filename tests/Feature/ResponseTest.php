<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello/')
        ->assertStatus(200)
        ->assertSeeText('Hello Response');
    }
    public function testHeader()
    {
        $this->get('/response/header')
        ->assertStatus(200)
        ->assertSeeText('Muhammad')
        ->assertSeeText('al imron')
        ->assertHeader('Content-Type', 'Application/json')
        ->assertHeader('Author', 'Muhammad Maulana Ishaq')
        ->assertHeader('App', 'Belajar-Laravel');
    }
    public function testView()
    {
        $this->get('/response/type/view')
        ->assertSeeText('Hello Muhammad');
    }
    public function testJson()
    {
        $this->get('/response/type/json')
        ->assertJson([
            'firstname' => 'muhammad',
            'lastname' => 'al imron'
        ]);
    }
    public function testFile()
    {
        $this->get('/response/type/file')
        ->assertHeader('Content-Type' , 'image/png');
    }
    public function testDownload()
    {
        $this->get('/response/type/download')
        ->assertDownload('Screenshot 2022-05-10 122153.png');
    }
}
