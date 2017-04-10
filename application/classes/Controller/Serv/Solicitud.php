<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Serv_Solicitud extends Controller_Main {

    public function action_new()
    {
        $oVehiculo = ORM::factory('Serv_Vehiculo')
            ->where('placa', '=', $this->request->param())
            ->find();

        if (!$oVehiculo->loaded())
            $this->redirect('/', 'El vehículo solicitado no se encuentra');

        if ($this->request->method() == 'POST')
        {
            $values = $this->request->post();

            $oSolicitud = ORM::factory('Serv_Solicitud');
            $oSolicitud->placa = $oVehiculo->placa;
            $oSolicitud->mecanico_id = $values['mecanico_id'];
            $oSolicitud->created_at = date('Y-m-d');
            $oSolicitud->save();

            $oServicioG = ORM::factory('Conf_Servicio', $values['serviciog_id']);
            $oServicioE = ORM::factory('Conf_Servicio', $values['servicioe_id']);

            if ($oServicioG->loaded())
                DB::insert('solicitud_servicio', array('solicitud_id', 'servicio_id', 'precio'))
                    ->values(array($oSolicitud->id, $oServicioG->id, $oServicioG->precio))
                    ->execute();

            if ($oServicioE->loaded())
                DB::insert('solicitud_servicio', array('solicitud_id', 'servicio_id', 'precio'))
                    ->values(array($oSolicitud->id, $oServicioE->id, $oServicioE->precio))
                    ->execute();

//            $oGarante = ORM::factory('Serv_Garantia');
//            $oGarante->solicitud_id = $oSolicitud->id;
//            $oGarante->f_inicio = date('Y-m-d');
//            $oGarante->f_final = Util::sumar_dias(date('Y-m-d'), $oServicioG->tiempo_garantia * 30);
//            $oGarante->save();

            $this->redirect('/solicitud/detail/' . $oSolicitud->id, 'Se ha creado una solicitud', 'success');
        }

        $aServicioG = ORM::factory('Conf_Servicio')
            ->where('tipo', '=', 1)
            ->find_all();

        $aServicioE = ORM::factory('Conf_Servicio')
            ->where('tipo', '=', 2)
            ->find_all();

        $aTecnico = ORM::factory('Conf_Mecanico')
            ->where('estado', '=', 1)
            ->find_all();

        $this->response->body(View::factory('solicitud/new')
                ->set('aServicioG', $aServicioG)
                ->set('aServicioE', $aServicioE)
                ->set('aTecnico', $aTecnico)
                ->set('oVehiculo', $oVehiculo));
    }

    public function action_detail()
    {
        $oSolicitud = ORM::factory('Serv_Solicitud', $this->request->param('id'));

        if (!$oSolicitud->loaded())
            $this->redirect('/', 'Error al obtener información de mantenimiento');

        $oVehiculo = ORM::factory('Serv_Vehiculo')
            ->where('placa', '=', $oSolicitud->placa)
            ->find();

        $aGarantiaM = ORM::factory('Serv_Garantiamecanico')
            ->where('garantia_id', '=', $oSolicitud->id)
            ->find_all();

        $oGarantia = ORM::factory('Serv_Garantia')
            ->where('solicitud_id', '=', $oSolicitud->id)
            ->find();

        $this->template->content = View::factory('solicitud/detail')
            ->set('aGarantiaM', $aGarantiaM)
            ->set('oGarantia', $oGarantia)
            ->set('oVehiculo', $oVehiculo)
            ->set('oSolicitud', $oSolicitud);
    }

    public function action_cerrar()
    {
        $oSolicitud = ORM::factory('Serv_Solicitud', $this->request->param('id'));

        if (!$oSolicitud->loaded())
            $this->redirect('/', 'Error al obtener información de mantenimiento');

        if ($this->request->method() == 'POST')
        {
            $oVehiculo = ORM::factory('Serv_Vehiculo')
                ->where('placa', '=', $oSolicitud->placa)
                ->find();

            $oSolicitud->estado = 3;
            $oSolicitud->save();

            $this->redirect('/solicitud/detail/' . $oSolicitud->id, 'Se he cancelado la solicitud correctamente', 'success');
        }

        $this->response->body(View::factory('solicitud/cerrar')
                ->set('oSolicitud', $oSolicitud));
    }

}
