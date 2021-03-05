<?php

/**
 * Class PremiumMember
 * extends member
 * it has additional details from user such as their interests and profile picture
 *
 * classes/premium_member.php
 * @author Blezyl Santos
 * @version 2.0
 */
class PremiumMember extends Member
{
    private $_indoorInterests;
    private $_outdoorInterests;
    private $_profilePic;

    /**
     * PremiumMember constructor.
     * @param $_fname string first name
     * @param $_lname string last name
     * @param $_age string age
     * @param $_gender string gender
     * @param $_phone string phone number
     * @param $_state string state
     * @param $_seeking string seeking
     * @param $_bio string bio
     * @param $_indoorInterests string
     * @param $_outdoorInterests string
     * @param $_profilePic string
     */
    public function __construct($_fname="", $_lname="", $_age="", $_gender="", $_phone="", $_state="", $_seeking="", $_bio="", $_indoorInterests="", $_outdoorInterests="", $_profilePic="images/profile.png")
    {
        parent::__construct($_fname, $_lname, $_age, $_gender, $_phone, $_state, $_seeking, $_bio);
        $this->_indoorInterests = $_indoorInterests;
        $this->_outdoorInterests = $_outdoorInterests;
        $this->_profilePic = $_profilePic;
    }

    /**
     * @return string all interests of the member
     */
    public function getIndoorInterests()
    {
        return $this->_indoorInterests;
    }

    /**
     * @param string sets $indoorInterests
     */
    public function setIndoorInterests($indoorInterests)
    {
        $this->_indoorInterests = $indoorInterests;
    }

    /**
     * @return string all interests of the member
     */
    public function getOutdoorInterests()
    {
        return $this->_outdoorInterests;
    }

    /**
     * @param string sets $outdoorInterests
     */
    public function setOutdoorInterests($outdoorInterests)
    {
        $this->_outdoorInterests = $outdoorInterests;
    }

    /**
     * @return string Profile Pic of the member
     */
    public function getProfilePic()
    {
        return $this->_profilePic;
    }

    /**
     * @param string sets $profilePic
     */
    public function setProfilePic($profilePic)
    {
        $this->_profilePic = $profilePic;
    }

}