<?php
/**
 * File 328/dating/index.php
 * File that routes files and display the html that is connected to the route
 * @author Blezyl Santos
 */
//Turn in error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// require the autoload file
require_once('vendor/autoload.php');
require_once('model/data-layer.php');
require_once('model/validation.php');
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
$f3->route('GET|POST /profile', function($f3) {
    // setting first and last name, age, gender, and phone
    // to session id
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $age = $_POST['age'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];

        if(validName($fname)){
            $_SESSION['fname'] = $fname;
        } else {
            $f3->set('errors["fname"]', "First name cannot be blank and must contain only characters");
        }

        if(validName($lname)){
            $_SESSION['lname'] = $lname;
        } else {
            $f3->set('errors["lname"]', "Last name cannot be blank and must contain only characters");
        }

        if(validAge($age)){
            $_SESSION['age'] = $age;
        } else {
            $f3->set('errors["age"]', "Age needs to be numeric and between 18 and 118");
        }

        if(validPhone($phone)){
            $_SESSION['phone'] = $phone;
        } else {
            $f3->set('errors["phone"]', "Invalid Phone number");
        }

        if(validGender($gender)){
            $_SESSION['gender'] = $gender;
        } else {
            $f3->set('errors["gender"]', "Go away, Evildoer");
        }

        //passed all cases
        if(empty($f3->get('errors'))) {
            $f3->reroute('/profile2');  //GET
        }
    }
    //var_dump($_SESSION);
    $view = new Template();
    echo $view->render("views/profile.html");
});


// define a profile email, state, bio, seeking
$f3 -> route ('GET|POST /profile2', function($f3){
    //var_dump($_POST);
    // echo "<h1> Hello, Dating </h1>";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $state = $_POST['state'];
        $seek = $_POST['seek'];
        if(validEmail($email)){
            $_SESSION['email'] = $email;
        } else {
            $f3->set('errors["email"]', "Invalid Email");
        }

        if(validState($state)){
            $_SESSION['state'] = $state;
        } else {
            $f3->set('errors["state"]', "Go Away, Evildoer");
        }
        if(validGender($seek)){
            $_SESSION['seek'] = $_POST['seek'];
        } else {
            $f3->set('errors["seek"]', "Go Away, Evildoer");
        }

        $_SESSION['bio'] = $_POST['bio'];
        if(empty($f3->get('errors'))) {
            $f3->reroute('/profile3');  //GET
        }
    }

    $f3->set("state", getState());
    $view = new Template();
    echo $view->render("views/profile2.html");
});

// define a profile interests
$f3 -> route ('POST /profile3', function($f3){
    // echo "<h1> Hello, Dating </h1>";
    //var_dump($_POST);
    //var_dump($_SESSION);

    $f3->set("indoor", getInInterests());
    $f3->set("outdoor", getOutInterests());

    $view = new Template();
    echo $view->render("views/profile3.html");

});

// define a profile summary
$f3 -> route ('POST /summary', function(){
    //var_dump($_POST);
    //var_dump($_SESSION);
    if(isset($_POST['interests'])){
        $_SESSION['interests'] = implode(", ", $_POST['interests']);
    }
    // echo "<h1> Hello, Dating </h1>";
    $view = new Template();
    echo $view->render("views/summary.html");
});

// run fat free
$f3->run();