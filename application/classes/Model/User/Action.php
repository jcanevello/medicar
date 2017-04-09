<?php

defined('SYSPATH') or die('No direct script access.');

class Model_User_Action extends ORM {

    protected $_table_name = 'usr_action';
    protected $_primary_key = 'id';
    
    protected $_has_many = array(
        'aProfileaction' => array(
            'model'         => 'User_Profileaction',
            'foreign_key'   => 'action_id'
        ),
        'aProfile' => array(
            'model'         => 'User_Profile',
            'foreign_key'   => 'profile_id',
            'through'       => 'usr_profile',
            'far_key'       => 'action_id',
        ),
    );
    
}
