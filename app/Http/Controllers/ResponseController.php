<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function response(Request $request): Response
    {
        return response("Hello Response");
    }
    public function header(Request $request): Response
    {
        $body = [
            'firstName' => 'Muhammad', 
            'lastName' => 'al imron'];
        
         return response(json_encode($body), 200)
            ->header('Content-Type', 'Application/json')
            ->withHeaders([
                'Author' => 'Muhammad Maulana Ishaq',
                'App' => 'Belajar-Laravel'
            ]);
    }
    public function responView(Request $request): Response
    {
        return response()
            ->view('hello', ['name' => 'Muhammad']);
    }
    public function responJson(Request $request): JsonResponse
    {
        $body = [
            'firstname' => 'muhammad',
            'lastname' => 'al imron'
        ];
        return response() 
        ->json($body);
    }
    public function responFile(Request $request): BinaryFileResponse
    {
        return response()
        ->file(storage_path('app/public/pictures/Screenshot 2022-05-10 122153.png'));
    }
    public function responDownload(Request $request): BinaryFileResponse
    {
        return response()
        ->download(storage_path('app/public/pictures/Screenshot 2022-05-10 122153.png'), 'Screenshot 2022-05-10 122153.png');
    }
}
