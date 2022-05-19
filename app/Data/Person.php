<?php

namespace App\Data;

class Person{
  
    public function __construct(
        public string $firstName = 'Muhammad',
        public string $lastName = 'Al Imron'
    ){
    }
}
