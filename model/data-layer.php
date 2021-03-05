<?php

/**
 * Class DataLayer
 * model/data-layer.php
 * all data for interests, pics, and states
 */
class DataLayer
{
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