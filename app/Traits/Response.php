<?php
namespace App\Traits;

Trait Response {

   public static function __callStatic($method, $parameters)
   {
       return (new static)->$method(...$parameters);
   }

       function json($arg, $httpCode=200){
        http_response_code($httpCode);  
           echo json_encode($arg);
       }


}