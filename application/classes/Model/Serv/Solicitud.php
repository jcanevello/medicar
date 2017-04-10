<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Serv_Solicitud extends ORM {

    protected $_table_name = 'solicitud';
    protected $_primary_key = 'id';

    public function oServicio()
    {
        $oServicio = ORM::factory('Conf_Servicio')
            ->join('solicitud_servicio')->on('solicitud_servicio.servicio_id', '=', 'conf_servicio.id')
            ->where('solicitud_servicio.solicitud_id', '=', $this->id)
            ->where('conf_servicio.tipo', '=', 1)
            ->find();

        return $oServicio;
    }

    public function oServicio2()
    {
        $oServicio = DB::select('s.nombre', 'ss.precio')
            ->from(array('servicio', 's'))
            ->join(array('solicitud_servicio', 'ss'))->on('ss.servicio_id', '=', 's.id')
            ->where('ss.solicitud_id', '=', $this->id)
            ->where('s.tipo', '=', 1)
            ->execute();

        return $oServicio[0];
    }

    public function oServicioE()
    {
        $oServicio = ORM::factory('Conf_Servicio')
            ->join('solicitud_servicio')->on('solicitud_servicio.servicio_id', '=', 'conf_servicio.id')
            ->where('solicitud_servicio.solicitud_id', '=', $this->id)
            ->where('conf_servicio.tipo', '=', 2)
            ->find();

        return $oServicio;
    }

    public function oServicioE2()
    {
        $oServicio = DB::select('s.nombre', 'ss.precio')
            ->from(array('servicio', 's'))
            ->join(array('solicitud_servicio', 'ss'))->on('ss.servicio_id', '=', 's.id')
            ->where('ss.solicitud_id', '=', $this->id)
            ->where('s.tipo', '=', 2)
            ->execute();

        return $oServicio[0];
    }

    public function oTecnico()
    {
        return ORM::factory('Conf_Mecanico', $this->mecanico_id);
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

    public function fin_garantia()
    {
        $oGarantia = ORM::factory('Serv_Garantia')
            ->where('solicitud_id', '=', $this->id)
            ->find();

        return $oGarantia->f_final;
    }
    
}
