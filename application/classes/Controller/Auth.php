<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller_Template {

    private $key_auth = null;
    private $name_cookie_token_form = null;

    public function before()
    {
        parent::before();

        $this->key_auth = Cookie::$salt;
        $this->name_cookie_token_form = 'token_form';
        $this->auto_render = false;
    }

    public function action_login()
    {
        $token = Cookie::get($this->name_cookie_token_form);

        if ($this->request->method() == 'POST')
        {
            if (empty($token))
                $this->redirect_custom('/login', 'El token ha expirado');
            elseif (!$this->validarToken($token))
                $this->redirect('/accessDenied');

            $validation = Validation::factory($this->request->post())
                ->rule('username', 'not_empty')
                ->rule('password', 'not_empty');

            if (!$validation->check())
                $this->redirect_custom('/login', 'Complete los campos');

            $username = rtrim(ltrim($this->request->post('username')));
            $password = rtrim(ltrim($this->request->post('password')));

            $oUser = ORM::factory('User_User')
                ->where('username', '=', $username)
                ->find();

            if (!$oUser->loaded())
                $this->redirect_custom('/login', 'El usuario no existe');

            $hash_password = Auth::instance()->hash($password . $oUser->key);

            if ($oUser->password != $hash_password)
            {
                if ($this->intentosLogin($oUser->id) > 4)
                    $this->redirect_custom('/login', 'Se ha excedido el número de intentos. La cuenta se desbloqueará dentro de 5 min');
                else
                {
                    $this->registerLogin($oUser->id);
                    $this->redirect_custom('/login', 'La contraseña es incorrecta');
                }
            }
            if (!$oUser->esActivo())
                $this->redirect_custom('/login', 'El usuario está inactivo');

            Cookie::delete($this->name_cookie_token_form);
            $datos_session = array(
                'user_id' => $oUser->id,
                'profile_id' => $oUser->profile_id,
            );

            Session::instance()->set('s', json_encode($datos_session));

            $this->redirect('/');
        }

        if (empty($token))
            $token = $this->generateTokenForm();
        elseif (!$this->validarToken($token))
            $this->redirect('/accessDenied');

        $error = Cookie::get('err');
        Cookie::delete('err');

        $this->response->body(View::factory('auth/login')
                ->set('error', $error));
    }

    public function action_logout()
    {
        Session::instance()->destroy('s');

        $error = NULL;

        $e = Controller_Main::getError();
        if (!empty($e->msj))
            $error = $e->msj;

        $this->redirect_custom('/login', $error);
    }

    public function action_changePass()
    {
        $session = Session::instance()->get('s');

        if (empty($session))
            $this->redirect('/logout');
        $session = json_decode($session);
        $oUser = ORM::factory('User_User', $session->user_id);
        $oSede = ORM::factory('Seat', $session->seat_id);
        $oProfile = ORM::factory('User_Profile', $session->profile_id);

        if (!$oUser->loaded())
            $this->redirect_custom('/logout', 'Los datos del usuario no fueron cargados.');
        if (!$oSede->loaded())
            $this->redirect_custom('/logout', 'No se tiene información de la sede.');
        if (!$oProfile->loaded())
            $this->redirect_custom('/logout', 'No se tiene información del perfil.');

        $error = null;

        if ($this->request->method() == 'POST')
        {
            $pass_nuevo = $this->request->post('pass_nuevo');
            $repetir_pass_nuevo = $this->request->post('pass_nuevo_repetido');

            $no_empty = (!empty($pass_nuevo));
            $min_length = strlen($pass_nuevo) > 10;
            preg_match_all('/[A-Z]/', $pass_nuevo, $mayusculas);
            $min_mayusculas = count(current($mayusculas)) > 0;
            preg_match_all('/[a-z]/', $pass_nuevo, $minuscula);
            $min_minusculas = count(current($minuscula)) > 0;
            preg_match_all('/[\d]/', $pass_nuevo, $digito);
            $min_digito = count(current($digito)) > 0;
            preg_match_all('/([\W])|([_])/', $pass_nuevo, $noalfanumerico);
            $min_noalfanumerico = count(current($noalfanumerico)) > 0;
            $pass_iguales = ($pass_nuevo === $repetir_pass_nuevo);

            if ($no_empty AND $min_length AND $min_mayusculas AND $min_minusculas AND $min_digito AND $min_noalfanumerico AND $pass_iguales)
            {
                $oUser->password = Auth::instance()->hash($pass_nuevo . $oUser->key);
                $oUser->updated_at = date('Y-m-d');
                $oUser->change_pass = 1;
                $oUser->save();

                $this->redirect('/logout');
            }

            if (!$no_empty)
                $error['no_empty'] = 'Ingresa una contraseña.';
            if (!$min_length)
                $error['min_length'] = 'La contraseña debe tener 10 caracteres como mínimo.';
            if (!$min_mayusculas)
                $error['min_mayusculas'] = 'La contraseña debe tener al menos una mayúscula.';
            if (!$min_minusculas)
                $error['min_minusculas'] = 'La contraseña debe tener al menos una minúscula.';
            if (!$min_digito)
                $error['min_digito'] = 'La contraseña debe tener al menos un dígito.';
            if (!$min_noalfanumerico)
                $error['min_alfanumerico'] = 'La contraseña debe tener al menos un caracter no alfanumerico';
            if (!$pass_iguales)
                $error['pass_iguales'] = 'No coinciden las contraseñas';
        }

        $this->response->body(View::factory('auth/changePass')
                ->set('error', $error));
    }

    private function redirect_custom($url, $error = NULL)
    {
        if (!empty($error))
            Cookie::set('err', $error);

        $this->redirect($url);
    }

    private function validarToken($token)
    {
        $dataCookie = $this->desenciptarDatos($token);

        $payload = $dataCookie['payload'];
        $verify = $dataCookie['verify'];
        $verify_generate = sha1(md5($payload) . $this->key_auth);
        $data = json_decode($payload);

        if ($verify != $verify_generate)
            return FALSE;
        if ($data->agent != $_SERVER['HTTP_USER_AGENT'])
            return FALSE;
        if ($data->host != $_SERVER['HTTP_HOST'])
            return FALSE;
        if ($data->protocolo != $_SERVER['SERVER_PROTOCOL'])
            return FALSE;

        return TRUE;
    }

    private function generateTokenForm()
    {
        $datos = array(
            'f_emision' => date("Y-m-d H:i:s"),
            'host' => $_SERVER['HTTP_HOST'],
            'agent' => $_SERVER['HTTP_USER_AGENT'],
            'protocolo' => $_SERVER['SERVER_PROTOCOL']
        );

        $datos = json_encode($datos);
        $token = $this->encriptarDatos($datos);

        Cookie::set($this->name_cookie_token_form, $token, 300); // límite de 5 min

        return $token;
    }

    private function desenciptarDatos($token)
    {
        $encrypt = Encrypt::instance();

        $array = explode('.', $encrypt->decode($token));
        $payload = $encrypt->decode(current($array));

        return array(
            'payload' => $payload,
            'verify' => $array[1]
        );
    }

    private function encriptarDatos($datos)
    {
        $encrypt = Encrypt::instance();

        return $encrypt->encode($encrypt->encode($datos) . '.' . sha1(md5($datos) . $this->key_auth));
    }

    private function intentosLogin($id_user)
    {
        $date = Util::operarMin(date("Y-m-d H:i:s"), '-5');

        $aTrylogin = ORM::factory('User_Trylogin')
            ->where('user_id', '=', $id_user)
            ->and_where('ip', '=', $_SERVER['REMOTE_ADDR'])
            ->and_where('date', '>=', $date)
            ->find_all();

        return count($aTrylogin);
    }

    private function registerLogin($id_user)
    {
        $Trylogin = ORM::factory('User_Trylogin');
        $Trylogin->user_id = $id_user;
        $Trylogin->ip = $_SERVER['REMOTE_ADDR'];
        $Trylogin->date = date("Y-m-d H:i:s");
        $Trylogin->save();
    }

    public function action_accessDenied()
    {
        die('Estamos vigilando tus actos ilícitos');
    }

    public function action_create_master()
    {
        die('Acceso denegado');

        $this->auto_render = false;
        try
        {
            $name_profile = Model::factory('User_Profile')->profile_master();
            $oProfile = ORM::factory('User_Profile')->where('name', '=', $name_profile)->find();

            if (!$oProfile->loaded())
            {
                $oProfile->name = $name_profile;
                $oProfile->status = ORM::factory('Tabla')->statusActive();
                $oProfile->save();

                $aAction = ORM::factory('User_Action')->find_all();

                foreach ($aAction as $oAction)
                {
                    $oProfileAction = ORM::factory('User_Profileaction');
                    $oProfileAction->action_id = $oAction->id;
                    $oProfileAction->profile_id = $oProfile->id;
                    $oProfileAction->save();
                }
            }

            $oUser = ORM::factory('User_User');
            $oUser->profile_id = $oProfile->id;
            $oUser->name = 'Administrador';
            $oUser->last_name = 'Sistema';
            $oUser->status = ORM::factory('Tabla')->statusActive();
            $oUser->username = strtolower('master');
            $oUser->key = Auth::instance()->hash($oUser->username);
            $oUser->password = Auth::instance()->hash($oUser->username . $oUser->key);
            $oUser->created_at = date('Y-m-d');

            $oUser->save();
            die('Éxito');
        } catch (Exception $exc)
        {
            echo 'Ya está creado';
        }
    }

}
