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
$f3->route ('GET /', function(){
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
            $f3->set('errors["gender"]', "Please Select a Gender");
        }

        //passed all cases
        if(empty($f3->get('errors'))) {
            $f3->reroute('/profile2');  //GET
        }
    }
    $f3->set('fname', isset($fname) ? $fname: "");
    $f3->set('lname', isset($lname) ? $lname: "");
    $f3->set('age', isset($age) ? $age: "");
    $f3->set('phone', isset($phone) ? $phone: "");
    $f3->set('gender', isset($gender) ? $gender: "");
    //var_dump($_SESSION);
    $view = new Template();
    echo $view->render("views/profile.html");
});


// define a profile email, state, bio, seeking
$f3->route ('GET|POST /profile2', function($f3){
    //var_dump($_POST);
    // echo "<h1> Hello, Dating </h1>";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $state = $_POST['state'];
        $seek = $_POST['seek'];
        $bio = $_POST['bio'];
        if(validEmail($email)){
            $_SESSION['email'] = $email;
        } else {
            $f3->set('errors["email"]', "Invalid Email");
        }

        if(validState($state)){
            $_SESSION['state'] = $state;
        } else {
            $f3->set('errors["state"]', "Please pick a state that is provided");
        }
        if(validGender($seek)){
            $_SESSION['seek'] = $_POST['seek'];
        } else {
            $f3->set('errors["seek"]', "Please pick a gender");
        }

        $_SESSION['bio'] = $bio;
        if(empty($f3->get('errors'))) {
            $f3->reroute('/profile3');  //GET
        }
    }

    $f3->set("states", getState());

    $f3->set('email', isset($email) ? $email: "");
    $f3->set('state', isset($state) ? $state: "");
    $f3->set('seek', isset($seek) ? $seek: "");
    $f3->set('bio', isset($bio) ? $bio: "");

    $view = new Template();
    echo $view->render("views/profile2.html");
});

// define a profile interests
$f3->route ('GET|POST /profile3', function($f3){
    // echo "<h1> Hello, Dating </h1>";
    //var_dump($_POST);
    //var_dump($_SESSION);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_SESSION['interests'] = "";
        if(isset($_POST['interestsIn'])){
            $interestsIn = $_POST['interestsIn'];
            if(validIndoor($interestsIn)){
                $_SESSION['interests'] .= implode(", ", $interestsIn);
            } else {
                $f3->set('errors["interestsIn"]', "STOP SPOOFING");
            }
        }
        if(isset($_POST['interestsOut'])){
            $interestsOut = $_POST['interestsOut'];
            if(validOutdoor($interestsOut)){
                if(!empty($_SESSION['interests'])){
                    $_SESSION['interests'] .= ", ";
                }
                $_SESSION['interests'] .= implode(", ", $interestsOut);
            } else {
                $f3->set('error["interestsOut"]', "Go Away, Evildoer");
            }
        }
        if(empty($f3->get('errors'))) {
            $f3->reroute('/summary');  //GET
        }
    }

    $f3->set("indoor", getInInterests());
    $f3->set("outdoor", getOutInterests());

    $view = new Template();
    echo $view->render("views/profile3.html");

});

// define a profile summary
$f3->route ('GET /summary', function(){
    //var_dump($_POST);
    //var_dump($_SESSION);
    $view = new Template();
    echo $view->render("views/summary.html");
    session_destroy();
});

// run fat free
$f3->run();