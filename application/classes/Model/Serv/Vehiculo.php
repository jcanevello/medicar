<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Serv_Vehiculo extends ORM {

    protected $_table_name = 'vehiculo';
    protected $_primary_key = 'placa';

    public function get_marca()
    {
        $oMarca = ORM::factory('Conf_Marca')
            ->join('modelo')->on('modelo.marca_id', '=', 'conf_marca.id')
            ->where('modelo.id', '=', $this->modelo_id)
            ->find();

        return $oMarca->nombre;
    }

    public function get_modelo()
    {
        $oModelo = ORM::factory('Conf_Modelo', $this->modelo_id);

        return $oModelo->nombre . ' ' . $oModelo->version;
    }

    public function oMarca()
    {
        $oMarca = ORM::factory('Conf_Marca')
            ->join('modelo')->on('modelo.marca_id', '=', 'conf_marca.id')
            ->where('modelo.id', '=', $this->modelo_id)
            ->find();
        
        return $oMarca;
    }

}
