<?php

/**
 * Class DataLayer
 * model/data-layer.php
 * all data for interests, pics, and states
 */
class DataLayer
{
    private $_dbh;

    /**
     * DataLayer constructor.
     * @param $_dbh
     */
    public function __construct($_dbh)
    {
        $this->_dbh = $_dbh;
    }

    function insertMember($member){

        $sql = "INSERT INTO member(`fname`, `lname`, `age`, `gender`, `phone`, `email`, `state`, `seeking`, `bio`, `premium`, `interests`, `image`) VALUES 
(:fname,:lname,:age,:gender,:phone, :email, :states, :seeking, :bio, :premium,:interests , :image)";

        //prepare the statement
        $statement = $this->_dbh->prepare($sql);

        $fname = $member->getFname();
        $lname = $member->getLname();
        $age = $member->getAge();
        $gender = $member->getGender();
        $phone = $member->getPhone();
        $email = $member->getEmail();
        $states = $member->getState();
        $seeking = $member->getSeeking();
        $bio = $member->getBio();
        if($member instanceof PremiumMember){
            $premium = 1;
            $interests = $member->getIndoorInterests();
            if($interests == ""){
                $interests = $member->getOutdoorInterests();
            } else {
                $interests .= ", ".  $member->getOutdoorInterests();
            }
            $image = $member->getProfilePic();
        } else {
            $premium = 0;
            $interests = "";
            $image = "";
        }

        $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
        $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
        $statement->bindParam(':age', $age, PDO::PARAM_INT);
        $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_INT);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':states', $states, PDO::PARAM_STR);
        $statement->bindParam(':seeking', $seeking, PDO::PARAM_STR);
        $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
        $statement->bindParam(':premium', $premium, PDO::PARAM_BOOL);
        $statement->bindParam(':interests', $interests, PDO::PARAM_STR);
        $statement->bindParam(':image', $image, PDO::PARAM_STR);

        $statement->execute();
        //print_r($member);
        //echo '<p>Added the Table</p>';
    }
    function getMembers(){
        $sql = "SELECT * FROM member";

        $statement = $this->_dbh->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);


    }
    function getMember($member_id){
        $sql = "SELECT * FROM member WHERE :member_id";

        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':member_id', $member_id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    function getInterests($member_id){
        $sql = "SELECT interests FROM member WHERE :member_id";

        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':member_id', $member_id, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }


    /**
     * @return Array a limited list of indoor interests
     */
    function getInInterests()
    {
        return array('tv', 'movies', 'cooking', 'board games', 'puzzles', 'reading', 'playing cards', 'video games');
    }

    /**
     * @return Array a limited list of outdoor interests
     */
    function getOutInterests()
    {
        return array('hiking', 'biking', 'swimming', 'collecting', 'walking', 'climbing');
    }

    /**
     * @return Array of accepatable type of pictures
     */
    function getExtensions(){
        return array('png', 'jpeg', 'jpg');
    }

    /**
     * @return Array the states in america
     */
    function getState()
    {
        return array(
            'Alabama',
            'Alaska',
            'Arizona',
            'Arkansas',
            'California',
            'Colorado',
            'Connecticut',
            'Delaware',
            'District of Columbia',
            'Florida',
            'Georgia',
            'Hawaii',
            'Idaho',
            'Illinois',
            'Indiana',
            'Iowa',
            'Kansas',
            'Kentucky',
            'Louisiana',
            'Maine',
            'Maryland',
            'Massachusetts',
            'Michigan',
            'Minnesota',
            'Mississippi',
            'Missouri',
            'Montana',
            'Nebraska',
            'Nevada',
            'New Hampshire',
            'New Jersey',
            'New Mexico',
            'New York',
            'North Carolina',
            'North Dakota',
            'Ohio',
            'Oklahoma',
            'Oregon',
            'Pennsylvania',
            'Rhode Island',
            'South Carolina',
            'South Dakota',
            'Tennessee',
            'Texas',
            'Utah',
            'Vermont',
            'Virginia',
            'Washington',
            'West Virginia',
            'Wisconsin',
            'Wyoming');
    }
}