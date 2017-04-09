<?php

defined('SYSPATH') or die('No direct script access.');

class Model_User_User extends ORM {

    protected $_table_name = 'usr_user';
    protected $_primary_key = 'id';
    protected $_actions = null;
    protected $_seat_local = null;
    protected $_belongs_to = array(
        'oProfile' => array(
            'model' => 'User_Profile',
            'foreign_key' => 'profile_id',
        ),
    );

    public function status()
    {
        $status = ORM::factory('Tabla')
            ->where('tabla', '=', 'status')
            ->and_where('value', '=', $this->status)
            ->find();

        return $status->name;
    }

    public function allAction()
    {
        $aAction = DB::select('action', 'controller')
            ->from('usr_action')
            ->join('usr_profile_action')->on('usr_profile_action.action_id', '=', 'usr_action.id')
            ->where('usr_profile_action.profile_id', '=', Controller_Main::getProfileid())
            ->execute();

        $aPermission[] = NULL;

        foreach ($aAction as $oAction)
        {
            if (!in_array($oAction['controller'], $aPermission))
                $aPermission[] = $oAction['controller'];

            $aPermission[] = $oAction['controller'] . $oAction['action'];
        }

        return $aPermission;
    }

    public function isAllowed($controller, $action = NULL)
    {
        if (!$this->master())
        {
            $aAction = $this->_actions;
            if (empty($aAction))
                return 'inactive';

            if (!in_array($controller . $action, $aAction))
                return 'inactive';
        }
        return NULL;
    }

    public function set_actions($data)
    {
        $this->_actions = $data;
    }

    public function oProfile()
    {
        return $oProfile = ORM::factory('User_Profile', Controller_Main::getProfileid());
    }

    public function fullName()
    {
        return strtoupper($this->name . ' ' . $this->last_name);
    }

    public function master()
    {
        return ($this->username == 'master') ? TRUE : FALSE;
    }

    public function esActivo()
    {
        return ($this->status == 1) ? TRUE : FALSE;
    }

    public function GenerarPassword() // 
    {   // TRUE O FALSE EN LA OPCIÓN QUE QUIERAS AÑADIR
 
        $opc_letras = TRUE; //  FALSE para quitar las letras
        $opc_numeros = TRUE; // FALSE para quitar los números
        $opc_letrasMayus = TRUE; // FALSE para quitar las letras mayúsculas
        $opc_especiales = TRUE; // FALSE para quitar los caracteres especiales
        $longitud = 10;
        $password = '';

        $letrasMayus = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $letras ="abcdefghijklmnopqrstuvwxyz";
        $numeros = "1234567890";
        $especiales ="|@#~$%()=^*+[]{}-_";
        $listado = "";

        if ($opc_letras == TRUE) {
            $listado .= $letras; }
        if ($opc_numeros == TRUE) {
            $listado .= $numeros; }
        if($opc_letrasMayus == TRUE) {
            $listado .= $letrasMayus; }
        if($opc_especiales == TRUE) {
            $listado .= $especiales; }
        
        $limite_letrasMayus = strlen($letrasMayus) - 1;
        $limite_letras = strlen($letras) - 1;
        $limite_numeros = strlen($numeros) - 1;
        $limite_especiales = strlen($especiales) - 1;
        
        $password .=$letrasMayus[rand(0,$limite_letrasMayus)];
        $password .=$letras[rand(0,$limite_letras)];
        $password .=$numeros[rand(0,$limite_numeros)];
        $password .=$especiales[rand(0,$limite_especiales)];
                
        $limite = strlen($listado) - 1;

        str_shuffle($listado);
        $longitud = 6;
        for( $i=0; $i<$longitud; $i++) {
            $password .= $listado[rand(0,$limite)];
            str_shuffle($listado);
        }
        $password = str_shuffle($password);
        
        return $password;
    }
    
     
}
