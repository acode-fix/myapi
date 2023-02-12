<?php
namespace App\Validations;

class Validator {

    //static  $arg;
     static $request;
        function __construct(){

               //static $arg =  $arg;
               //static $request =  $request;
                self::handle();     
         }

          

            static  function handle($arg=[],$request=[]){
                  self::$request =  $request;
                    $res = [];
                 foreach(  $arg as $key=>$args){
                         $expresses  =  explode('|',$args);
                                  $hasError=false;
                         foreach($expresses as $exp){
                           // check :
                              if(  strpos($exp,':')){

                                      //  filesize:300
                                list($key_, $val_) = explode(':',$exp);
                                    $arr = [$key_ => $val_];
                                           if(!empty(self::{$key_}($val_, $key))){
                                                 $res[] = self::{$key_}($val_, $key);
                                                 $hasError = TRUE;
                                                }       
                              }
                               else {
                                 if(!empty(self::{$exp}($key))){
                                  $res[] = self::{$exp}($key); 
                                    $hasError = TRUE;
                                 }

                                }

                                   if($hasError)
                                      break; 
                         }
                 }

                 return $res;

            }

              static function required($arg){
                 
                   if(empty(SELF::$request[$arg]) )
                       return [$arg=>$arg.' is required'];
                       else 
                        return; 

              } 

              static function numeric($arg){
                if(!is_numeric(SELF::$request[$arg])  )
                    return [$arg=>$arg.' is not a numeric value'];
                    else 
                     return; 
           }
           
           static function string($arg){
            if(!is_string(SELF::$request[$arg])  )
                return [$arg=>$arg.' is not a string value'];
                else 
                 return; 
           }

           static function file($arg){
            if(!isset( $_FILES[$arg])  )
                return [$arg=>$arg.' is not a file.'];
                else 
                 return; 
       }

       static function filesize($size, $arg){   // filesize must be in MB
        if(isset( $_FILES[$arg])  ){
                 if( $_FILES[$arg]['size']  >   $size ) 
                 return [$arg=>$arg." must less than $size"]; 
                   else 
                     return;
        } else 
             return; 
   }

       static function email($arg){
        if(!filter_var(SELF::$request[$arg], FILTER_VALIDATE_EMAIL)  )
            return [$arg=>$arg.' is invalid email'];
            else 
             return; 
   }

}