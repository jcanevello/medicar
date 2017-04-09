<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_User_User extends Controller_Main {

    private $_oUser = NULL;

    public function before()
    {
        parent::before();

        $this->template->content = View::factory('configuration/template');

        $oUser = ORM::factory('User_User', $this->request->param('id'));

        if ($oUser->loaded())
        {
            $this->_oUser = $oUser;
            $this->template->content->content_config = View::factory('user/template')
                ->set('oUser', $oUser);
        }
//        $this->template->navbar = View::factory('user/navbar')->set('oUser', $this->oUser)
//                ->set('sede_local', $this->sede);
    }

    public function action_index()
    {
        $aUser = ORM::factory('User_User')
            ->order_by('id', 'DESC')
            ->find_all();

        $this->template->content = View::factory('user/list')
            ->set('aUser', $aUser);
    }

    public function action_edit()
    {
        if (empty($this->_oUser))
            $this->redirect('/user', 'No se cargaron los datos del usuario.');

        if ($this->request->method() == 'POST')
        {
            $validation = Validation::factory($this->request->post())
                ->rule('profile_id', 'not_empty')
                ->rule('name', 'not_empty')
                ->rule('last_name', 'not_empty')
                ->rule('token', 'not_empty');

            if (!$validation->check())
                $this->redirect('/user/detail/' . $this->_oUser->id, Util::msj_error($validation->errors('form')));

            if (!Security::check($this->request->post('token')))
                $this->redirect('/user/detail/' . $this->_oUser->id, 'Token invalido. Inténtelo nuevamente.');

            if (!ORM::factory('User_Profile', $this->request->post('profile_id'))->loaded())
                $this->redirect('/user/detail/' . $this->_oUser->id, 'No existe el perfil seleccionado');

            $oUser = $this->_oUser;

            $oUser->values($this->request->post());
            $oUser->username = $this->_oUser->username;
            $oUser->key = $this->_oUser->key;
            $oUser->password = $this->_oUser->password;
            $oUser->save();

            $this->redirect('/user/detail/' . $this->_oUser->id, 'Actualización exitosa', 'success');
        }
    }

    public function action_new()
    {
        if ($this->request->method() == 'POST')
        {
            if ($this->request->is_ajax())
                $this->redirect('/user', 'Acceso no autorizado');

            if (!Security::check($this->request->post('token')))
                $this->redirect('/user', 'Token invalido. Inténtelo nuevamente.');

            $username = $this->request->post('username');

            $oUserRegister = ORM::factory('User_User')
                ->where('username', '=', $username)
                ->find();

            if ($oUserRegister->loaded())
                $this->redirect('/user/', 'El username ya se encuentra registrado');

            if (!ORM::factory('User_Profile', $this->request->post('profile_id'))->loaded())
                $this->redirect('/user', 'No existe el perfil seleccionado');

            $oUser = ORM::factory('User_User');
            $oUser->values($this->request->post());
            $oUser->username = $username;
            $oUser->key = Auth::instance()->hash($oUser->username);
            $oUser->password = Auth::instance()->hash($oUser->username . $oUser->key);
            $oUser->created_at = date('Y-m-d');

            $oUser->save();

            $this->redirect('/user/detail/' . $oUser->id);
        }

        if (!$this->request->is_ajax())
            $this->redirect('/user', 'Acceso no autorizado');

        $aProfile = ORM::factory('User_Profile')
            ->where('status', '=', 1)
            ->and_where('value', '<>', 1)
            ->find_all();

        $this->response->body(View::factory('user/new')
                ->set('token', Security::token())
                ->set('aProfile', $aProfile)->render());
    }

    public function action_detail()
    {
        if (empty($this->_oUser))
            $this->redirect('/user', 'No se cargaron los datos del usuario.');

        $aProfile = ORM::factory('User_Profile')
            ->where('status', '=', 1)
            ->and_where('value', '<>', 1)
            ->find_all()
            ->as_array('id', 'name');

        $this->template->content->content_config->content_user = View::factory('user/detail')
            ->set('oUser', $this->_oUser)
            ->set('token', Security::token())
            ->set('aStatus', ORM::factory('Tabla')->aStatus())
            ->set('aProfile', $aProfile);
    }

    public function action_config()
    {
        $this->template->content = View::factory('user/config');
    }

    public function action_password_reset()
    {
        $oUser = ORM::factory('User_User', $this->request->param('id'));
        if (!$oUser->loaded())
            $this->redirect('/user', 'No existe el usuario seleccionado');

        $pass_nuevo = $oUser->GenerarPassword(); //str_shuffle

        $no_empty = (!empty($pass_nuevo));
        $min_length = strlen($pass_nuevo) >= 10;
        preg_match_all('/[A-Z]/', $pass_nuevo, $mayusculas);
        $min_mayusculas = count(current($mayusculas)) > 0;
        preg_match_all('/[a-z]/', $pass_nuevo, $minuscula);
        $min_minusculas = count(current($minuscula)) > 0;
        preg_match_all('/[\d]/', $pass_nuevo, $digito);
        $min_digito = count(current($digito)) > 0;
        preg_match_all('/([\W])|([_])/', $pass_nuevo, $noalfanumerico);
        $min_noalfanumerico = count(current($noalfanumerico)) > 0;

//              $pass_nuevo=utf8_decode('abcdEFGH12');
        if ($no_empty AND $min_length AND $min_mayusculas AND $min_minusculas AND $min_digito AND $min_noalfanumerico)
        {
            $oUser->password = Auth::instance()->hash($pass_nuevo . $oUser->key);
            $oUser->updated_at = date('Y-m-d');
            $oUser->change_pass = 0;
            $oUser->save();
        } else
        {
            $this->redirect('/user/password_reset/' . $oUser->id);
        }

        if (!$this->request->is_ajax())
            $this->redirect('/', 'Acceso inválido.');

        $this->response->body(View::factory('/user/modal_password')
                ->set('username', $oUser->username)  //$oUser->username
                ->set('pass_nuevo', $pass_nuevo)
                ->set('user_id', $oUser->id));
    }

}
