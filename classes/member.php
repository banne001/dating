<?php

/**
 * Class Member
 * A class to set all user details such as name, age, gender, phone, email,
 * state, seeking, and bio
 * classes/member.php
 * @author Blezyl Santos
 * @version 2.0
 */
class Member
{
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;


    /**
     * Member constructor.
     * @param $_fname string first name
     * @param $_lname string last name
     * @param $_age string age
     * @param $_gender string gender
     * @param $_phone string phone number
     * @param $_state string state
     * @param $_seeking string seeking
     * @param $_bio string bio
     */
    public function __construct($_fname="", $_lname="", $_age="", $_gender="", $_phone="", $_email = "", $_state="", $_seeking="", $_bio="")
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_age = $_age;
        $this->_gender = $_gender;
        $this->_phone = $_phone;
        $this->_email = $_email;
        $this->_state = $_state;
        $this->_seeking = $_seeking;
        $this->_bio = $_bio;
    }

    /**
     * @return string get the email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param string sets $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return string gets first name
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @param string sets $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @return string get last name
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @param string sets $lname
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return string get age
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * @param string set $age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * @return string get gender
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * @param string set $gender
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * @return string gets phone number
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param string sets $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return string gets state
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param string sets $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @return string get seeking gender
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * @param string sets $seeking
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return string get bio
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * @param string sets $bio
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }
}