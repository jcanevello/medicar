<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_User_Profile extends Controller_Main {

    public function before()
    {
        parent::before();

        $this->template->content = View::factory('configuration/template');
    }

    public function action_index()
    {
        $aProfile = ORM::factory('User_Profile')
            ->where('value', '<>', 1)
            ->find_all();
        
        $this->template->content = View::factory('profile/list')
            ->set('aProfile', $aProfile);
    }

    public function action_edit()
    {
        $this->action_new(TRUE);
    }

    public function action_new($edit = FALSE)
    {
        $oProfile = ORM::factory('User_Profile', $this->request->param('id'));
        if ($edit AND ! $oProfile->loaded())
            $this->redirect('/profile');

        if ($this->request->method() == 'POST')
        {
            $oProfile->name = $this->request->post('name');
            $oProfile->status = $edit ? $this->request->post('status') : 1;
            $oProfile->save();

            $aActionSelected = $this->request->post('permit');

            if ($edit)
                $oProfile->removeActions();

            for ($i = 0; $i < count($aActionSelected); $i++)
            {
                $oProfileAction = ORM::factory('User_Profileaction');
                $oProfileAction->action_id = $aActionSelected[$i];
                $oProfileAction->profile_id = $oProfile->id;
                $oProfileAction->save();
            }

            $this->redirect('/profile/edit/'.$oProfile->id);
        }

        $this->template->content = View::factory('profile/new')
            ->set('oProfile', $oProfile)
            ->set('aStatus', ORM::factory('Tabla')->aStatus())
            ->set('aAction', ORM::factory('User_Action')->order_by('id', 'DESC')->find_all());
    }

}
