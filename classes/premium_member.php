<?php
class PremiumMember extends Member
{
    private $_indoorInterests;
    private $_outdoorInterests;

    public function __construct($_fname, $_lname, $_age, $_gender, $_phone, $_state, $_seeking, $_bio, $_indoorInterests, $_outdoorInterests)
    {
        parent::__construct($_fname, $_lname, $_age, $_gender, $_phone, $_state, $_seeking, $_bio);
        $this->_indoorInterests = $_indoorInterests;
        $this->_outdoorInterests = $_outdoorInterests;
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
}