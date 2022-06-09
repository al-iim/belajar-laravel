<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    
    public function testHello()
    {
        $this->get('/controller/hello/im')
        ->assertSeeText('Halo guys im');
    }
    public function testRequest()
    {
        $this->get('/controller/hello/request', [
            "Accept" => "plain/text"
        ])
        ->assertSeeText("controller/hello/request")
        ->assertSeeText("http://belajar-laravel.test/controller/hello/request")
        ->assertSeeText("GET")
        ->assertSeeText("plain/text");
    }
}
