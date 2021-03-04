<?php
/*
 * model/validate.php
 * Contains validation functions for Dating app
 */
class Validator{
    private $_dataLayer;
    function __construct($dataLayer){
        $this->_dataLayer = $dataLayer;
    }
    /**
     * validName() returns true if is not empty
     * @param $name String  the input to be checked
     * @return bool true if valid, else false
     */
    function validName($name) {
        //$validFood=array("tacos", "eggs". "pizza");
        return !empty($name) && ctype_alpha($name);
    }

    /** validAge() returns true if the age is a numeric and between 18 and 118
     * @param $age int  the input to be checked
     * @return bool true if valid, else false
     */
    function validAge($age)
    {
        return is_numeric($age) && $age >= 18 && $age <= 118;
    }

    /** validPhone() returns true if the phone is a valid number
     * @param $phone String the input to be checked
     * @return bool true if valid, else false
     */
    function validPhone($phone)
    {
        if (preg_match("/^[0-9]{10}+$/", $phone)) {
            return true;
        }
        return false;
    }

    /**
     * validEmail() returns true if the email is valid
     * @param $email String input to be checked
     * @return bool true if valid, else false
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
     * @param $outdoor String input to be checked
     * @return bool true if valid, else false
     */
    function validOutdoor($outdoor)
    {
        $validOut = getOutInterests();
        foreach ($outdoor as $out) {
            if (!in_array($out, $validOut)) {
                return false;
            }
        }
        return true;
    }

    /**
     * validIndoor() returns true if the picked indoor interests is valid
     * @param $indoor string the input to be checked
     * @return bool true if valid, else false
     */
    function validIndoor($indoor)
    {
        $validIn = getInInterests();
        foreach ($indoor as $in) {
            if (!in_array($in, $validIn)) {
                return false;
            }
        }
        return true;
    }

    /**
     *
     * @param $gender string the input to be checked
     * @return bool  true if valid, else false
     */
    function validGender($gender)
    {
        if ($gender == 'female' || $gender == 'male') {
            return true;
        }
        return false;
    }

    /**
     * @param $state string makes sure state is a valid state
     * @return bool true if valid, else false
     */
    function validState($state)
    {
        $states = $this->_dataLayer->getState();
        return in_array($state, $states);
    }
}