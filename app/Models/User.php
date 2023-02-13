<?php

namespace App\Models;
use App\Models\Model;
  //use Src\DB;


class  User  extends Model  {


      function __construct( )
      {

        
           
      }


        protected function setPassword($name)
        {

          return password_hash($name,PASSWORD_DEFAULT);
        }


          // protected checkAttrbutes($attributes){

          //   $definedCol = [];
          //   foreach( $attributes  as $column ){
               


          //   }

          // }



       static function  findAll(){

            $query = "SELECT * FROM users WHERE deleted = 0 ";
          $result =  Model::Query($query)   
                               ->gets();
          return $result;

       }

       static function  store($columns=[]){
       
            // $definedCol = [];
            // foreach( $columns  as $column ){
           

            // }
              
        
        $result =  Model::create(__CLASS__,$columns);
      return $result;

   }


   static function updateWithManyClauses($column=[],$clause=[]){
 
$result =  Model::updateWithAndClause(__CLASS__,$column,$clause);
return $result;

}


static function softDeleteWithClauses(array $clause=[]){

  $result =  Model::softDeleteWithClause(__CLASS__,$clause);
  return $result;
  
  }
 

   


}