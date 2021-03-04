<?php
class PremiumMember extends Member
{
    private $_indoorInterests;
    private $_outdoorInterests;
    private $_profilePic;

    public function __construct($_fname="", $_lname="", $_age="", $_gender="", $_phone="", $_state="", $_seeking="", $_bio="", $_indoorInterests="", $_outdoorInterests="", $_profilePic)
    {
        parent::__construct($_fname, $_lname, $_age, $_gender, $_phone, $_state, $_seeking, $_bio);
        $this->_indoorInterests = $_indoorInterests;
        $this->_outdoorInterests = $_outdoorInterests;
        $this->_profilePic = $_profilePic;
    }

    /**
     * @return mixed
     */
    public function getIndoorInterests()
    {
        return $this->_indoorInterests;
    }

    /**
     * @param mixed $indoorInterests
     */
    public function setIndoorInterests($indoorInterests)
    {
        $this->_indoorInterests = $indoorInterests;
    }

    /**
     * @return mixed
     */
    public function getOutdoorInterests()
    {
        return $this->_outdoorInterests;
    }

    /**
     * @param mixed $outdoorInterests
     */
    public function setOutdoorInterests($outdoorInterests)
    {
        $this->_outdoorInterests = $outdoorInterests;
    }

    /**
     * @return mixed
     */
    public function getProfilePic()
    {
        return $this->_profilePic;
    }

    /**
     * @param mixed $profilePic
     */
    public function setProfilePic($profilePic)
    {
        $this->_profilePic = $profilePic;
    }

}