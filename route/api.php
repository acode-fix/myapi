<?php

 use \Bramus\Router\Router;
 use App\Controllers\userController;
 use App\Traits\Response;

//  header("Access-Control-Allow-Origin: *");
//  header("Content-Type: application/json; charset=UTF-8");
//  header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
//  header("Access-Control-Max-Age: 3600");
//  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE ");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



// Create Router instance
$router = new Router();



$router->set404(function() {
  
   // header('HTTP/1.1 404 Not Found');
    header('Content-Type: application/json');
    
    $json =[];
    $json['status'] = "error";
    $json['status_text'] = "request not found";
    echo Response::json($json,404);
});

$router->get('/about', function() {
    echo 'About Page Contents';
});

//$router->get('/api/v1/user/{id}','userController@getList');

$router->get('/api/v1/user', function() {
     userController::getList();
});

$router->post('/api/v1/user', function() {
      userController::store();
});

$router->put('/api/v1/user/{id}', function($id) {
    userController::update($id);
});


$router->post('/api/v1/user/{id}/upload', function($id) {
    userController::uploadImage($id);
});

$router->delete('/api/v1/user/{id}', function($id) {
     userController::destroy($id);
});

// Run it!
$router->run();