<?php

namespace App\Models;
use  App\DB;
use App\Traits\Inflectors;

class  Model {

       protected static $query;
       protected static $modelName; 
       

      function __construct()
      {
                 
      }


      protected  function   setPasswordHash($name){

          return password_hash($name,PASSWORD_DEFAULT);

      }


         function Query($sql){
              static::$query = $sql;
                return new static;
        }

        function gets(){
           $db = new DB();
           if(!$db->Open()) $db->Kill();           
         if ( !$db->Query(  static::$query ) )  $db->Kill();
         $rows =    $db->RecordsArray();
         return $rows;
               
        }

        function runInsert(){
          $db = new DB();
          if(!$db->Open()) $db->Kill();           
        if ( !$db->Query(  static::$query ) ) {
         $db->Kill();
           return  FALSE;
        }
         else   
        return $db->GetLastInsertID();
              
       }

       function run(){
        $db = new DB();
        if(!$db->Open()) $db->Kill();           
      if ( !$db->Query(  static::$query ) ) {
       $db->Kill();
         return  FALSE;
      }
       else   
      return TRUE;
            
     }

        static function create($class,array $columns=[]){

          static::$modelName =  Inflectors::plurize($class);
                      
          $k = 0; $columName = $columnValue = ''; 
            foreach( $columns as $name=>$value)
            {
                     if($k == 0){
                      $columName = "( `$name`";
                      $columnValue = "( '$value'";
                   }else {
                    $columName .= ", `$name`";
                    $columnValue .= ", '$value'";
                   }            
                    $k++;     
       }
         $columName .=", `created_at`, `updated_at`";
         $columnValue .= ", '".date('Y-m-d h:i:s')."', '".date('Y-m-d h:i:s')."'";
       $columName .= " )";
       $columnValue .= " )";
                 $modelName = static::$modelName;
         $query  = "INSERT INTO $modelName $columName VALUES $columnValue";
        //  echo  $query;
        //   return;
         static::$query = $query;
      $result =   self::runInsert();
           //echo $result;
      return $result;

   }

   static function updateWithAndClause($class,array $columns=[], array $clauses=[]){
                      
          static::$modelName =  Inflectors::plurize($class);
           // echo get_called_class();
         //return;
    $k = 0; $columName = $clauseName = ''; 
      foreach( $columns as $name=>$value)
      {
               if($k == 0){
                $columName = "`$name` = '$value'";
             }else {
              $columName .= ", `$name` = '$value'";
              
             }            
              $k++;     
 }
         
     $k = 0;
 foreach( $clauses as $name=>$value)
 {
          if($k == 0){
           $clauseName = "`$name` = '$value'";
        }else {
         $clauseName .= " AND `$name` = '$value'";
         
        }            
         $k++;     
}



   $columName .=", `updated_at` = '".date('Y-m-d h:i:s')."'";
    $clauseName .= "  AND deleted = 0 ";  
 
           $modelName = static::$modelName;
   $query  = "UPDATE $modelName SET $columName WHERE  $clauseName";
  // echo  $query;
   static::$query = $query;
    $result =   self::run();
   return $result;

}

 
static function softDeleteWithClause($class, array $clauses=[]){
              //  get actual name of child model and pluralize it for db table         
  static::$modelName =  Inflectors::plurize($class);
   // echo get_called_class();
 //return;
$k = 0;  $clauseName = ''; 
 
$k = 0;
foreach( $clauses as $name=>$value)
{
  if($k == 0){
   $clauseName = "`$name` = '$value'";
}else {
 $clauseName .= " AND `$name` = '$value'";
 
}            
 $k++;     
}



 //$columName .=", `updated_at` = '".date('Y-m-d h:i:s')."'";
$clauseName .= "  AND deleted = 0 "; 
$columName = " deleted = 1 , updated_at = '".date('Y-m-d h:i:s')."'";  

   $modelName = static::$modelName;
$query  = "UPDATE $modelName SET $columName WHERE  $clauseName";
// echo  $query;
  //return;
static::$query = $query;
$result =   self::run();
return $result;

}




}