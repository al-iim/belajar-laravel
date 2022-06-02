<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Viewtest extends TestCase
{
    public function testHello()
    {
        $response = $this->get('/hello')
        ->assertSeeText('Hello Muzammil Nadhif Abqory');
    }
    public function testHelloAgain()
    {
        $response = $this->get('/hello-again')
        ->assertSeeText('Hello Alanna Nahwa Almahyra');
    }
}
