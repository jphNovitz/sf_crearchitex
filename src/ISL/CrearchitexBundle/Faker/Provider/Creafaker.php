<?php

namespace ISL\CrearchitexBundle\Faker\Provider;

class Creafaker extends \Faker\Provider\Base {
     public function nom(){
         return $this->generator->lastName;
     }
     public function prenom(){
         return $this->generator->firstName;
     }
     public function description(){
         return $this->generator->sentence(15);
     }
    

}
