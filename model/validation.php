<?php
/**
 * validName() returns true if is not empty
 * @param $name
 * @return bool
 */
function validName($name){
    //$validFood=array("tacos", "eggs". "pizza");
    return !empty($name) && ctype_alpha($name);
}

/** validAge() returns true if the age is a numeric and between 18 and 118
 * @param $age
 * @return bool
 */
function validAge($age)
{
    return is_numeric($age) && $age >= 18 && $age <=118;
}

/** validPhone() returns true if the phone is a valid number
 * @param $phone
 * @return bool
 */
function validPhone($phone)
{
    if(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone)) {
        return true;
    }
    return false;
}

/**
 * validEmail() returns true if the email is valid
 * @param $email
 * @return bool
 */
function validEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

/**
 * validOutdoor() returns true if the picked outdoor interests is valid
 * @param $outdoor
 * @return bool
 */
function validOutdoor($outdoor)
{
    $validOut = getOutInterests();
    foreach ($outdoor as $out){
        if(!in_array($out, $validOut)){
            return false;
        }
    }
    return true;
}

/**
 * validIndoor() returns true if the picked indoor interests is valid
 * @param $outdoor
 * @return bool
 */
function validIndoor($outdoor)
{
    $validIn = getInInterests();
    foreach ($outdoor as $out){
        if(!in_array($out, $validIn)){
            return false;
        }
    }
    return true;
}

function validGender($gender){
    if($gender == 'female' || $gender=='male'){
        return true;
    }
    return false;
}


function validState($state){
    $states = getState();
    return in_array($state, $states);
}