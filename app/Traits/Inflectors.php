<?php
namespace App\Traits;
use ICanBoogie\Inflector;

Trait Inflectors {

   public static function __callStatic($method, $parameters)
   {
       return (new static)->$method(...$parameters);
   }

       function plurize($name){

          $Inflector = Inflector::get();
       $plurizeName =    $Inflector->pluralize( strtolower((new \ReflectionClass($name))->getShortName()));
          return  $plurizeName;
       }


}