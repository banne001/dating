<?php
/**
 * File 328/dating/index.php
 * File that routes files and display the html that is connected to the route
 * @author Blezyl Santos
 */
//Turn in error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);



// require the autoload file
require_once('vendor/autoload.php');
require $_SERVER['DOCUMENT_ROOT'].'/../config.php';

session_start();
// create an instance of the Base class
$f3 = Base::instance();
$f3-> set('DEBUG', 3);

$dataLayer = new DataLayer($dbh);
$validator = new Validator($dataLayer);
$controller = new Controller($f3);

$member = "";
// define a default route (home page)
$f3->route ('GET /', function(){
    // echo "<h1> Hello, Dating </h1>";
    global $controller;
    $controller->home();

});

//Define an create profile route
$f3->route('GET|POST /profile', function() {
    global $controller;
    $controller->profile1();
});


// define a profile email, state, bio, seeking
$f3->route ('GET|POST /profile2', function(){
    global $controller;
    $controller->profile2();
});

// define a profile interests
$f3->route ('GET|POST /profile3', function(){
    global $controller;
    $controller->profile3();
});

// define a profile summary
$f3->route ('GET /summary', function(){
    global $controller;
    $controller->summary();
});

$f3->route('GET|POST /admin', function(){
    global $controller;
    $controller->admin();
});

// define a profile summary
$f3->route ('GET /profiles', function(){
    global $controller;
    $controller->profiles();
});

$f3->route('GET /logout', function(){
    global $controller;
    $controller->logout();
});
// run fat free
$f3->run();