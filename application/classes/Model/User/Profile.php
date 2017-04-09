<?php

defined('SYSPATH') or die('No direct script access.');

class Model_User_Profile extends ORM {

    protected $_table_name = 'usr_profile';
    protected $_primary_key = 'id';
    
    protected $_has_many = array(
        'aProfileaction' => array(
            'model'         => 'User_Profileaction',
            'foreign_key'   => 'profile_id'
        ),
        'aAction' => array(
            'model'         => 'User_Action',
            'foreign_key'   => 'action_id',
            'through'       => 'usr_profile_action',
            'far_key'       => 'profile_id',
        ),
        'aUser' => array(
            'model'         => 'User_User',
            'foreign_key'   => 'profile_id',
        ),
    );
    
    public function status()
    {
        $status =  ORM::factory('Tabla')
            ->where('tabla', '=', 'status')
            ->where('value', '=', $this->status)
            ->find();
        
        return $status->name;
    }
    
    public function isSelectedAction($action_id)
    {
        $action = $this->aProfileaction->where('action_id', '=', $action_id)->find();
        
        if($action->loaded()) return TRUE;
        
        return FALSE;
        
    }
    
    public function profile_master()
    {
        return 'all';
    }
    
    public function hasPermission()
    {
        $oProfileAction = ORM::factory('User_Profileaction')
            ->join('usr_action')->on('usr_action.id', '=', 'action_id')
            ->where('profile_id', '=', Controller_Main::getProfileid())
            ->and_where('usr_action.action', '=', Request::$initial->action())
            ->and_where('usr_action.controller', '=', Request::$initial->controller())
            ->find();
        
        return $oProfileAction->loaded();
    }
    
    public function removeActions()
    {
        DB::delete('usr_profile_action')
            ->where('profile_id', '=', $this->id)
            ->execute();
    }
}
