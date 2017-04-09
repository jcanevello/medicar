<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller_Template {

    public $template = 'template';
    public $header = 'header';
    public $navbar = 'navbar';
    public $footer = 'footer';
    public $oUser = null;
    public $profile_id = null;
    private static $profile_id_static = null;
    private static $seat_id_static = null;

    public function before()
    {
        parent::before();

        $this->auto_render = ($this->request->is_ajax()) ? FALSE : TRUE;

        $session = Session::instance()->get('s');

        if (empty($session))
            $this->redirect('/logout');
        $session = json_decode($session);
        $oUser = ORM::factory('User_User', $session->user_id);
        $oProfile = ORM::factory('User_Profile', $session->profile_id);

        if (!$oUser->loaded())
            $this->redirect('/logout', 'Los datos del usuario no fueron cargados.');
        if (!$oProfile->loaded())
            $this->redirect('/logout', 'No se tiene información del perfil.');

        $this->oUser = $oUser;
        $this->profile_id = $session->profile_id;
        self::$profile_id_static = $session->profile_id;

        /*
         * Obtenemos el contenido del error y luego borramos de la cookie
         */
        $error = Controller_Main::getError();
        /* Fin */

        if ((!(empty($this->oUser))))
        {
            if (!$this->oUser->esActivo())
                $this->redirect('/logout', 'El usuario se encuentra inactivo');

            $oPermission = $this->oUser->oProfile->hasPermission();
            $oAction = ORM::factory('User_Action')
                ->where('action', '=', Request::$initial->action())
                ->and_where('controller', '=', Request::$initial->controller())
                ->find();

            if (!$this->request->is_ajax() AND ! $oPermission)
                if (!$oUser->master())
                    $this->redirect('/', 'No estás autorizado para realizar esta acción.');

            $this->oUser->set_actions($this->oUser->allAction());

            $this->template->header = View::factory('header')
                ->set('oUser', $this->oUser)
                ->set('oProfile', $oProfile)
                ->set('error', $error);

            $this->template->navbar = View::factory('navbar')
                ->set('oUser', $this->oUser)
                ->set('oProfile', $oProfile);

            $this->template->footer = View::factory('footer');
        }
        else
        {
            $this->redirect('/logout');
        }
    }

    public function after()
    {
        parent::after();
    }

    public function action_ajax()
    {
        return json_encode(NULL);
    }

    public static function redirect($uri = '', $error = NULL, $tipo = NULL)
    {
        Controller_Main::setError($error, $tipo);
        parent::redirect($uri, $code = 302);
    }

    public static function setError($e, $t = NULL)
    {
        if (!empty($e))
        {
            $tipo = $t ? $t : 'error';

            $error = array(
                'msj' => $e,
                'tipo' => $tipo
            );

            Cookie::set('error', json_encode($error), 60);
        }
    }

    public static function getError()
    {
        $error = Cookie::get('error');
        Cookie::delete('error');
        return json_decode($error);
    }

    public static function getProfileid()
    {
        return self::$profile_id_static;
    }

}

// End Welcome
