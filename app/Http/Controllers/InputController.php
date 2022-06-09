<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request): string
    {
        $name = $request->input('nama');
        return "Hello Input " . $name;
    }
    public function helloFirst(Request $request): string
    {
        $firstName = $request->input('name.awal');
        return "Hello " . $firstName;
    }
    public function helloInput(Request $request): string
    {
        $input = $request->input();
        return json_encode($input);
    }
    public function arrayInput(Request $request): string
    {
        $input = $request->input('products.*.name');
        return json_encode($input);
    }
    public function inputType(Request $request): string
    {
        $name = $request->input('name');
        $isMarried = $request->boolean('married');
        $birthDate = $request->date('birth_date','Y-m-d');

        return json_encode([
            "nama" => $name,
            "menikah" => $isMarried,
            "kelahiran" => $birthDate->format('d-m-Y')
        ]);
    }
    public function filterOnly(Request $request): string
    {
        $name = $request->only(['name.firstname', 'name.lastname']);
        return json_encode($name);
    }
    public function filterExcept(Request $request): string
    {
        $user = $request->except(['admin']);
        return json_encode($user);
    }
    public function filterMerge(Request $request): string
    {
        $request->merge(['admin' => false]);
        $user = $request->input();
        return json_encode($user);
    }
}
