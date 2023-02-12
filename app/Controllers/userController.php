<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\User;
  use App\Validations\Validator;
  use App\Requests\Request;
  


class  userController    extends BaseController  {


      function __construct()
      {

        
      }



        static function store(){
         
                   $request  =   Request::handle(); 
            
                       $validation = [
                     'surname'=>'required|string',
                     'firstname'=>'required|string',
                     'phone'=>'required',
                     'email'=>'required|email'
                       ];
             $validateError = Validator::handle($validation,$request);    
                    // self::json($validate);
                        if($validateError){
                        return  self::json($validateError);
                        }
             //store 
               
                 $user =  User::store($request);
                     if($user ){

                      $res = [];
                      $res['status'] = "success";
                      $res['message'] = 'data stored successfully';
                      $res['data'] = $user;

                     }else {
                    
                      $res = [];
                      $res['status'] = "error";
                      $res['message'] = 'data not stored successfully';
                      $res['data'] = [];

                     }

                     return self::json($res);
        }



       static function getList(){

            $user =  User::findAll();
            //  return $user;
              if($user){

                  $data_user = [];
                  $res = [];
                  $res['status'] = "success";
                  $res['message'] = 'data fetched successfully';
                  $res['data'] = $user;
                  $res['message'] = 'fetched successfully';

                  return self::json($res);

              }else{
                  $res['status'] = "success";
                  $res['message'] = 'data fetched successfully';
                  $res['data'] = [];                
                   return self::json($res);
              }

        }


        static function update($id){
         
          $request  =   Request::handle(); 
          
   
              $validation = [
            'surname'=>'required|string',
            'firstname'=>'required|string',
            'phone'=>'required',
            'email'=>'required|email'
              ];
    $validateError = Validator::handle($validation,$request);    
           // self::json($validate);
               if($validateError){
               return  self::json($validateError);
               }
    //store 
          // print_r($request);
          // return;
        
        $user =  User::updateWithManyClauses($request,['id'=>$id]);
            if($user ){

             $res = [];
             $res['status'] = "success";
             $res['message'] = 'data updated successfully';
             $res['data'] = $user;

            }else {
           
             $res = [];
             $res['status'] = "error";
             $res['message'] = 'data not updated successfully';
             $res['data'] = [];

            }

            return self::json($res);
}

static function uploadImage($id){
         
     $request  =   Request::handle(); 
         
         // print_r($_FILES);
          // foreach($_FILES as $key=>$val)
          //       $k = $key;
          //       print_r(isset($_FILES[$k]));
           

      $validation = [
        'surname'=>'required', 
            'passport'=>'required|file|filesize:409600'
              ];


$validateError = Validator::handle($validation,$request);    
   // self::json($validate);
       if($validateError){
        return self::json($validateError);
       }
        
            $fileName =  Request::getFileName('passport');
            $ext =  Request::getFileExtension($fileName);
              $storeFileName =  Request::getHashNameForFile($fileName).'.'.$ext;
               $tmp_path = Request::getFilTempPath('passport');
                if(!Request::moveUploadedFile(getenv('UPLOAD_PATH'),$tmp_path,$storeFileName)) 
                  return self::json(['passport'=>'file is not upload']);
                  $data = ['passport'=> getenv('UPLOAD_URL').'/'.$storeFileName];
              
$user =  User::updateWithManyClauses($data,['id'=>$id]);
    if($user ){

     $res = [];
     $res['status'] = "success";
     $res['message'] = 'data updated successfully';
     $res['data'] = $user;

    }else {
   
     $res = [];
     $res['status'] = "error";
     $res['message'] = 'data not updated successfully';
     $res['data'] = [];

    }

    return self::json($res);
}




static function destroy($id){
          
     // echo $_SERVER['REQUEST_METHOD'];
    

$user =  User::softDeleteWithClauses(['id'=>$id]);
    if($user ){

     $res = [];
     $res['status'] = "success";
     $res['message'] = 'data deleted successfully';
     $res['data'] = $user;

    }else {
   
     $res = [];
     $res['status'] = "error";
     $res['message'] = 'data not deleted successfully';
     $res['data'] = [];

    }

    return self::json($res);
}




}