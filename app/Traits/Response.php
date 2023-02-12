<?php
namespace App\Traits;

Trait Response {

   public static function __callStatic($method, $parameters)
   {
       return (new static)->$method(...$parameters);
   }

       function json($arg){
          return  json_encode($arg);
       }


}