<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?nama=imron')
        ->assertSeeText('Hello Input imron');
        
        $this->post('/input/hello', ['nama' => 'imron'])
        ->assertSeeText('Hello Input imron');
    }
    public function testInputNested()
    {
        $this->post('/input/hello/nested', [
            'name' => [
                'awal' => 'Muhammad',
                'akhir' => 'al imron'
            ]
        ])
        ->assertSeeText('Hello Muhammad');
    }
    public function testInputAll()
    {
        $this->post('/input/hello/input',[
            'name' => [
                'awal' => 'Alanna',
                'tengah' => 'Nahwa',
                'akhir' => 'Almahyra'
            ]
        ])-> assertSeeText("name")->assertSeeText("awal")->assertSeeText("Alanna")
        ->assertSeeText("tengah")->assertSeeText("Nahwa")->assertSeeText("akhir")->assertSeeText("Almahyra");
    }
    public function testInputArray()
    {
        $this->post('/input/hello/array',[
            'products' => [
                [
                    'name' => 'rizka',
                    'umur' => '26'
                ],
                [
                    'name' => 'imron',
                    'umur' => '27'
                ]
            ]
        ])->assertSeeText("rizka")->assertSeeText("imron");
    }
    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            'name' =>
            [
                'firstname' => 'muhammad',
                'middlename' => 'al',
                'lastname' => 'imron'
            ]
        ])->assertSeeText('muhammad')->assertSeeText('imron')->assertDontSeeText('al');
    }
    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            'user' => 'imron', 
            'admin' => 'rizka', 
            'punggawa' => 'muzammil'
        ])->assertSeeText('imron')->assertSeeText('muzammil')->assertDontSeeText('rizka');
    }
    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            'user' => 'imron', 
            'admin' => 'rizka', 
            'punggawa' => 'muzammil'
        ])->assertSeeText('imron')->assertSeeText('muzammil')->assertSeeText('admin')->assertSeeText('false');
    }
}
