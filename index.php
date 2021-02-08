<?php

//Turn in error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// require the autoload file
require_once('vendor/autoload.php');
require_once('model/data-layer.php');
// create an instance of the Base class
$f3 = Base::instance();
$f3-> set('DEBUG', 3);

// define a default route (home page)
$f3 -> route ('GET /', function(){
    // echo "<h1> Hello, Dating </h1>";
    $view = new Template();
    echo $view->render("views/home.html");
});

//Define an create profile route
$f3->route('GET|POST /profile', function() {
    $view = new Template();
    echo $view->render("views/profile.html");
});


// define a profile email, state, bio, seeking
$f3 -> route ('POST /profile2', function(){
    var_dump($_POST);
    // echo "<h1> Hello, Dating </h1>";
    // setting first and last name, age, gender, and phone
    // to session id
    if(isset($_POST['fname'])){
        $_SESSION['fname'] = $_POST['fname'];
    }
    if(isset($_POST['lname'])){
        $_SESSION['lname'] = $_POST['lname'];
    }
    if(isset($_POST['age'])){
        $_SESSION['age'] = $_POST['age'];
    }
    if(isset($_POST['gender'])){
        $_SESSION['gender'] = $_POST['gender'];
    }
    if(isset($_POST['phone'])){
        $_SESSION['phone'] = $_POST['phone'];
    }
    $view = new Template();
    echo $view->render("views/profile2.html");
});

// define a profile interests
$f3 -> route ('POST /profile3', function($f3){
    // echo "<h1> Hello, Dating </h1>";
    var_dump($_POST);
    var_dump($_SESSION);
    if(isset($_POST['email'])){
        $_SESSION['email'] = $_POST['email'];
    }
    if(isset($_POST['state'])){
        $_SESSION['state'] = $_POST['state'];
    }
    if(isset($_POST['bio'])){
        $_SESSION['bio'] = $_POST['bio'];
    }
    if(isset($_POST['seek'])){
        $_SESSION['seek'] = $_POST['seek'];
    }
    $f3->set("indoor", getInInterests());
    $f3->set("outdoor", getOutInterests());

    $view = new Template();
    echo $view->render("views/profile3.html");

});

// define a profile summary
$f3 -> route ('POST /summary', function(){
    var_dump($_POST);
    var_dump($_SESSION);
    if(isset($_POST['interests'])){
        $_SESSION['interests'] = implode(",", $_POST['interests']);
    }
    // echo "<h1> Hello, Dating </h1>";
    $view = new Template();
    echo $view->render("views/summary.html");
});

// run fat free
$f3->run();