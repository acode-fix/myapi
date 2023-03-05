<?php

 use \Bramus\Router\Router;
 use App\Controllers\userController;
 use App\Traits\Response;

 header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
 header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
 header('Content-Type: application/json');
// $method = $_SERVER['REQUEST_METHOD'];
//  if ($method == "OPTIONS") {
//  header('Access-Control-Allow-Origin: *');
//  header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
//  header("HTTP/1.1 200 OK");
//  die();
//  }


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