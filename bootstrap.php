<?php

require 'vendor/autoload.php';

// error_reporting(0);
use Dotenv\Dotenv;
//use Src\DotEnv;
// (new DotEnv(__DIR__ . '/.env'))->load();
  //putenv('PATH',__DIR__);

  

$dotenv = new DotEnv(__DIR__);
//$dotenv->createImmutable(__DIR__, 'PATH');

$dotenv->load();

  //use ICanBoogie\Inflector;
//$inflector = Inflector::get('en');
//echo Inflector::pluralize( strtolower('user')); 

   
define("DB_HOST", getenv('DB_HOST'));   
define("DB_NAME", getenv('DB_NAME'));
define("DB_USER", getenv('DB_USER'));
define("DB_PASS", getenv('DB_PASS'));
   

  //echo  getenv('APP_NAME');
 // echo $en;
require 'route/api.php';