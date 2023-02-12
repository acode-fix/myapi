<?php
namespace App\Requests;
class Request{

        function __construct()
        {
            
        }

            static function  handle(){
  
                  //  fetch all data in query string, files, body http request

                 
              // print_r($_SERVER['REQUEST_METHOD']);
                
               $getQueryStrArr = $body = $post =  $get= $file =  $request = [];


              $queryString =   $_SERVER['QUERY_STRING'];
                 parse_str($queryString, $getQueryStrArr);
                        if($getQueryStrArr)
                          $request[] = $getQueryStrArr; 

                          if($_POST){
                            
                            $post = $_POST;
                          }
                          if($_GET){
                            $get = $_GET;
                          }
                            $PUT = [];
                  if( $_SERVER['REQUEST_METHOD'] == 'PUT' ){

                    $putfp = fopen('php://input', 'r');
                    $putdata = '';
                    while($data = fread($putfp, 1024))
                        $putdata .= $data;
                    fclose($putfp);
                    $body_ = $putdata;
                     

                  }
                 else 
                  $body_ =  file_get_contents('php://input');
                       
                         if(!empty($body_)){
                            $body =   json_decode($body_, true);
                         }
                       
                          

                           if($_FILES){
                            foreach($_FILES as $key=>$val)
                              $filekey = $key;
                             $file[$filekey] = $_FILES[$filekey]; 
                              // $request[] = $file;
                           }

                         
                            $request = array_merge($getQueryStrArr,$post,$get,$body,$file);     

                     //  print_r($request);
                          return $request;

          }


                 static function moveUploadedFile($path,$temp_path,$file_name){
                 
                      if(move_uploaded_file($temp_path,$path.'/'.$file_name))
                           return $file_name;
                     

               }

                 static function getFileExtension($fileName){
                     $ext =   strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                     return $ext;
                 }

                 static function getHashNameForFile($fileName){
                       return str_shuffle(mt_rand(10000,99999).substr(sha1($fileName),0,10)); 
                 }

                 static function getFileName($file){
                    return   $_FILES[$file]['name']; 
              }

              static function getFilTempPath($file){
                return   $_FILES[$file]['tmp_name']; 
          }

          static function getFilSize($file){
            return   $_FILES[$file]['size']; 
      }

}