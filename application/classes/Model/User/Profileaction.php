<?php

defined('SYSPATH') or die('No direct script access.');

class Model_User_Profileaction extends ORM {

    protected $_table_name = 'usr_profile_action';
    protected $_primary_key = 'id';
    
    protected $_belongs_to = array(
        'oProfile' => array(
            'model'         => 'User_Profile',
            'foreign_key'   => 'profile_id',
        ),
        'oAction'        => array(
            'model'         => 'User_Action',
            'foreign_key'   => 'action_id'
        )
    );
    
}
