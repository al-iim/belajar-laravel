<?php

namespace App\Data;
/*
|--------------------------------------------------------------------------
| Foo dan Bar
|--------------------------------------------------------------------------
| 
| Dari class Foo dan Bar kita tahu bahwa Bar membutuhkan Foo, artinya Bar depends-on Foo, atau Foo adalah dependency untuk Bar
| Pada kode Foo dan Bar kita menggunakan Constructor untuk melakukan injection (memasukkan dependency),
| sebenarnya caranya tidak hanya menggunakan Constructor, bisa menggunakan Attribute atau Function,
| namun sangat direkomendasikan menggunakan Constructor agar bisa terlihat jelas dependencies nya 
| dan kita tidak lupa menambahkan dependencies nya
|
*/
class bar{
    // private foo $foo;
    public foo $foo;
    public function __construct(foo $foo){
        $this->foo = $foo;
    }
    public function bar(): string{
        return $this->foo->foo() . ' and bar';
    }
}
