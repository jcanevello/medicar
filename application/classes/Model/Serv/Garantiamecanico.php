<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Serv_Garantiamecanico extends ORM {

    protected $_table_name = 'garantia_mecanico';
    protected $_primary_key = 'id';

    public function oSolicitud()
    {
        $oSolicitud = ORM::factory('Serv_Solicitud')
            ->where('id', '=', $this->garantia_id)
            ->find();

        return $oSolicitud;
    }

    public function oTecnico()
    {
        $otecnico = ORM::factory('Conf_Mecanico')
            ->where('id', '=', $this->mecanico_id)
            ->find();

        return $otecnico;
    }

    public function get_estado()
    {
        $value = '';
        switch ($this->estado)
        {
            case 1:
                $value = 'Ejecutando';
                break;
            case 2:
                $value = 'Terminado';
                break;
            case 3:
                $value = 'Cancelado';
                break;
        }

        return $value;
    }

    public function get_estado_label()
    {
        $value = 'label-';
        switch ($this->estado)
        {
            case 1:
                $value .= 'success';
                break;
            case 2:
                $value .= 'default';
                break;
            case 3:
                $value .= 'danger';
                break;
        }

        return $value;
    }

}
