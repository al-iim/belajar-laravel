<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieTest extends TestCase
{
    public function testCookie()
    {
        $this->get('/cookie/set')
        ->assertCookie('User-Id','imron')
        ->assertCookie('Is-Member', 'true');
    }
    public function testGetCookie()
    {
        $this
        ->withCookie('User-Id', 'imron')
        ->withCookie('Is-Member', 'true')
        ->get('/cookie/get')
        ->assertJson([
            'userId'=> 'imron',
            'isMember' => 'true'
        ]);
    }

}
