<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectTest extends TestCase
{
    public function testRedirect()
    {
        $this->get('/redirect/from')
        ->assertSeeText('/redirect/to');
    }
    public function testRedirectName()
    {
        $this->get('/redirect/nama')
        ->assertRedirect('/redirect/nama/muzammil_anak_sholeh');
    }
    public function testRedirectAction()
    {
        $this->get('redirect/action')
        ->assertRedirect('/redirect/nama/imron');
    }
}
