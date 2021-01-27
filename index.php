<?php

//Turn in error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require the autoload file
require_once('vendor/autoload.php');
// create an instance of the Base class
$f3 = Base::instance();
$f3-> set('DEBUG', 3);

// define a default route (home page)
$f3 -> route ('GET /', function(){
    // echo "<h1> Hello, Dating </h1>";
    $view = new Template();
    echo $view->render("views/home.html");
});

// run fat free
$f3->run();