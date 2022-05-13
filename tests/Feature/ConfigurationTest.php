<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
   public function testConfig(){
       $firstname = config('contoh.author.first');
       $lastname = config('contoh.author.last');
       $web = config('contoh.web');
       $email = config('contoh.email');

       self::assertEquals('al imron', $firstname);
       self::assertEquals('muhammad', $lastname);
       self::assertEquals('belajar-laravel.com', $web);
       self::assertEquals('muhammad.al.imron@um.ac.id', $email);
   }
}
