<?php
//controllers/controller.php

/**
 * Class Controller
 * Sends the user to needed views
 */
class Controller
{

    private $_f3;

    /**
     * Controller constructor.
     * @param $_f3
     */
    public function __construct($_f3)
    {
        $this->_f3 = $_f3;
    }

    /**
     * View Home Page
     */
    function home(){
        $view = new Template();
        echo $view->render("views/home.html");
    }

    /**
     * View Profile1 Page
     * Creates member or premiumMember and puts all data into object then to
     * session
     */
    function profile1(){
        global $validator;
        // setting first and last name, age, gender, and phone
        // to session id
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $fname = trim($_POST['fname']);
            $lname = trim($_POST['lname']);
            $age = $_POST['age'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];

            if(isset($_POST['premium'])){
                $member = new PremiumMember();
            } else {
                $member = new Member();
            }

            if($validator->validName($fname)){
                //$_SESSION['fname'] = $fname;
                $member->setFname($fname);
            } else {
                $this->_f3->set('errors["fname"]', "First name cannot be blank and must contain only characters");
            }

            if($validator->validName($lname)){
                //$_SESSION['lname'] = $lname;
                $member->setLname($lname);
            } else {
                $this->_f3->set('errors["lname"]', "Last name cannot be blank and must contain only characters");
            }

            if($validator->validAge($age)){
                //$_SESSION['age'] = $age;
                $member->setAge($age);
            } else {
                $this->_f3->set('errors["age"]', "Age needs to be numeric and between 18 and 118");
            }

            if($validator->validPhone($phone)){
                //$_SESSION['phone'] = $phone;
                $member->setPhone($phone);
            } else {
                $this->_f3->set('errors["phone"]', "Invalid Phone number");
            }
            if(isset($gender)){
                if($validator->validGender($gender)){
                    //$_SESSION['gender'] = $gender;
                    $member->setGender($gender);
                } else {
                    $this->_f3->set('errors["gender"]', "STOP SPOOFING");
                }
            }
            //passed all cases
            if(empty($this->_f3->get('errors'))) {
                $_SESSION['member'] = $member;
                $this->_f3->reroute('/profile2');  //GET
            }
        }
        //print_r($member);
        //stick inputs
        $this->_f3->set('fname', isset($fname) ? $fname: "");
        $this->_f3->set('lname', isset($lname) ? $lname: "");
        $this->_f3->set('age', isset($age) ? $age: "");
        $this->_f3->set('phone', isset($phone) ? $phone: "");
        $this->_f3->set('gender', isset($gender) ? $gender: "");
        //var_dump($_SESSION);
        $view = new Template();
        echo $view->render("views/profile.html");
    }

    /**
     * View Profile2 Page
     * Puts all data into session
     * data is email, seeking, bio, and state
     */
    function profile2(){
        global $dataLayer;
        global $validator;
        //var_dump($_POST);
        //var_dump($_SESSION);
        // echo "<h1> Hello, Dating </h1>";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'];
            $state = $_POST['state'];
            $seek = $_POST['seek'];
            $bio = $_POST['bio'];
            if($validator->validEmail($email)){
                //echo "THIS IS THE $email";
                //$_SESSION['email'] = $email;
                $_SESSION['member']->setEmail($email);
            } else {
                $this->_f3->set('errors["email"]', "Invalid Email");
            }

            if($state!="pick"){
                if($validator->validState($state)){
                    //$_SESSION['state'] = $state;
                    $_SESSION['member']->setState($state);
                } else {
                    $this->_f3->set('errors["state"]', "Please pick a state that is provided");
                }
            }

            if(isset($seek)){
                if($validator->validGender($seek)){
                    //$_SESSION['seek'] = $_POST['seek'];
                    $_SESSION['member']->setSeeking($seek);
                } else {
                    $this->_f3->set('errors["seek"]', "Stop Spoofing");
                }
            }
            $_SESSION['member']->setBio($bio);
            if(empty($this->_f3->get('errors'))) {
                if(is_a($_SESSION['member'], 'PremiumMember')){
                    $this->_f3->reroute('/profile3');  //GET
                }
                $this->_f3->reroute('/summary');
            }
        }

        $this->_f3->set("states", $dataLayer->getState());
        //sticky
        $this->_f3->set('email', isset($email) ? $email: "");
        $this->_f3->set('state', isset($state) ? $state: "");
        $this->_f3->set('seek', isset($seek) ? $seek: "");
        $this->_f3->set('bio', isset($bio) ? $bio: "");

        $view = new Template();
        echo $view->render("views/profile2.html");
    }

    /**
     * View Profile3 Page. Only display if they are a premium member
     * Puts all data into session
     * data is interests and profile pic
     */
    function profile3(){
        global $dataLayer;
        global $validator;
        //var_dump($_POST);
        //var_dump($_SESSION);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['interestsIn'])){
                $interestsIn = $_POST['interestsIn'];
                if($validator->validIndoor($interestsIn)){
                    //$_SESSION['interests'] .= implode(", ", $interestsIn);
                    $_SESSION['member']->setIndoorInterests(implode(", ", $interestsIn));
                } else {
                    $this->_f3->set('errors["interestsIn"]', "STOP SPOOFING");
                }
            }
            if(isset($_POST['interestsOut'])){
                $interestsOut = $_POST['interestsOut'];
                if($validator->validOutdoor($interestsOut)){
                    $_SESSION['member']->setOutdoorInterests(implode(", ", $interestsOut));
                    //$_SESSION['interests'] .= implode(", ", $interestsOut);
                } else {
                    $this->_f3->set('errors["interestsOut"]', "Go Away, Evildoer");
                }
            }
            //echo $_FILES['fileToUpload']['name'];
            if(!empty($_FILES['fileToUpload']['name'])){
                $fileName = $_FILES['fileToUpload']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                if($validator->validExtension($fileExtension)==true) {
                    //File Details
                    //$fileSize = $_FILES['fileToUpload']['size'];
                    //$fileType = $_FILES['fileToUpload']['type'];
                    $fileTmpPath = $_FILES['fileToUpload']['tmp_name'];

                    //sanitize file name
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                    $uploadFileDir = 'images/';
                    $dest_path = $uploadFileDir . $newFileName;
                    $_SESSION['member']->setProfilePic($dest_path);
                    if(move_uploaded_file($fileTmpPath, $dest_path)) {
                        echo 'File is successfully uploaded.';
                    }
                    else {
                        echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                    }
                    //var_dump($_SESSION);
                } else {
                    $this->_f3->set('errors["pics"]', "Invalid file type");
                }
            }

            if(empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('/summary');  //GET
            }
        }

        $this->_f3->set("indoor", $dataLayer->getInInterests());
        $this->_f3->set("outdoor", $dataLayer->getOutInterests());

        $view = new Template();
        echo $view->render("views/profile3.html");
    }

    /**
     * Displays all data in the previous profile pages
     */
    function summary(){
        //var_dump($_POST);
        //var_dump($_SESSION);
        global $dataLayer;
        $dataLayer->insertMember($_SESSION['member']);
        $view = new Template();
        echo $view->render("views/summary.html");
        session_destroy();
    }

    /**
     * Admin Login page
     */
    function admin(){
        global $validator;
        // if he form has been submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //echo "Form has beem submitted";
            // Get the username and password
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            // if they are correct
            if($validator->validLogin($username, $password)){
                //echo "Login is correct";
                // redirect to index page
                $_SESSION['loggedin'] = true;
                $this->_f3->reroute('/profiles');
            }
            // Set an error flag
            $this->_f3->set('errors["usernameL"]', $username);
            $this->_f3->set('errors["login"]', true);
        }
        $view = new Template();
        echo $view->render("views/admin.html");
    }

    /**
     * Displays all Profiles created
     */
    function profiles(){
        //var_dump($_POST);
        //var_dump($_SESSION);
        if (!isset($_SESSION['loggedin'])) {
            //Redirect to home
            $this->_f3->reroute('/admin');
        }
        global $dataLayer;
        $members = $dataLayer->getMembers();
        $this->_f3->set('member', $members);
        $view = new Template();
        echo $view->render("views/allProfiles.html");
    }

    /**
     * logouts the admin
     */
    function logout(){
        session_destroy();
        $_SESSION = array();
        $this->_f3->reroute('/');
    }
}