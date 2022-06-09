<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    public function testUpload()
    {
    // jangan lupa nyalakan extensi | extension=gd | di php.ini mysql, baik di installer php di c maupun di php myadmin nya
    // lalu lakukan hal di bawah ini
    // Use Windows Power Shell, as an Admin, and npm install --global --production windows-build-tools
    // If you had previous made any npm installation attempt - which you must certainly had, 
    //to be reading theses lines right now - you have to clean everything, and do a fresh dependency intsllation:
    // $ rm node_modules -R
    // $ rm package-lock.json
    // $ npm install 
        $image = UploadedFile::fake()->image('imron.png');
        $this->post('/file/upload', ['picture'=>$image])
        ->assertSeeText("Ok : imron.png");
    }
}
