<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Caja_Boleta extends Controller_Main {

    public function action_buscarservicios()
    {
        $result = FALSE;
        $mensaje = NULL;
        if ($this->request->method() == 'POST')
        {
            $result = TRUE;
            $placa = $this->request->post('placa');

            $oVehiculo = ORM::factory('Serv_Vehiculo')
                ->where('placa', '=', $placa)
                ->find();

            if (!$oVehiculo->loaded())
                $mensaje = 'La placa ' . $placa . ' no se encuentra registrada.';

            $aSolicitud = ORM::factory('Serv_Solicitud')
                ->where('placa', '=', $placa)
                ->and_where('estado', '=', 1)
                ->find_all();

            $aGarantiaM = ORM::factory('Serv_Garantiamecanico')
                ->join('garantia')->on('garantia.solicitud_id', '=', 'serv_garantiamecanico.garantia_id')
                ->join('solicitud')->on('solicitud.id', '=', 'garantia.solicitud_id')
                ->where('solicitud.placa', '=', $oVehiculo->placa)
                ->and_where('serv_garantiamecanico.estado', '=', 1)
                ->find_all();

            $this->template->content = View::factory('caja/buscar_servicios')
                ->set('result', $result)
                ->set('mensaje', $mensaje)
                ->set('placa', $placa)
                ->set('aSolicitud', $aSolicitud)
                ->set('aGarantiaM', $aGarantiaM);
        }
        else
        {
            $this->template->content = View::factory('caja/buscar_servicios')
                ->set('result', $result);
        }
    }

    public function action_generar()
    {
        $oSolicitud = ORM::factory('Serv_Solicitud')
            ->where('id', '=', $this->request->param('id'))
            ->find();

        if (!$oSolicitud->loaded())
            $this->redirect('/boleta/buscarservicios', 'El vehículo no presenta estos servicios');

        $oBoleta = ORM::factory('Serv_Boleta')
            ->where('solicitud_id', '=', $oSolicitud->id)
            ->find();

        if ($oBoleta->loaded())
            $this->redirect('/boleta/detail/' . $oBoleta->num_boleta);

        $oServicioG = $oSolicitud->oServicio2();
        $oServicioE = $oSolicitud->oServicioE2();

        $monto = $oServicioG['precio'];
        if (!empty($oServicioE))
            $monto += $oServicioE['precio'];

        if ($this->request->method() == 'POST')
        {
            $nombre = $this->request->post('nombre');

            $oBoleta = ORM::factory('Serv_Boleta');
            $oBoleta->solicitud_id = $oSolicitud->id;
            $oBoleta->nombre = $nombre;
            $oBoleta->monto = $monto;
            $oBoleta->created_at = date('Y-m-d');
            $oBoleta->save();

            $oServicioGeneral = $oSolicitud->oServicio();

            $oGarante = ORM::factory('Serv_Garantia');
            $oGarante->solicitud_id = $oSolicitud->id;
            $oGarante->f_inicio = date('Y-m-d');
            $oGarante->f_final = Util::sumar_dias(date('Y-m-d'), $oServicioGeneral->tiempo_garantia * 30);
            $oGarante->save();

            $oSolicitud->estado = 2;
            $oSolicitud->save();

            $this->redirect('/boleta/detail/' . $oBoleta->num_boleta, 'Se ha generado una nueva boleta', 'success');
        }

        $this->template->content = View::factory('caja/boleta')
            ->set('oServicioG', $oServicioG)
            ->set('oServicioE', $oServicioE)
            ->set('monto', $monto)
            ->set('oSolicitud', $oSolicitud);
    }

    public function action_detail()
    {
        $oBoleta = ORM::factory('Serv_Boleta')
            ->where('num_boleta', '=', $this->request->param('id'))
            ->find();

        if (!$oBoleta->loaded())
            $this->redirect('/boleta/buscarservicios', 'No se ha encontrado la boleta de pago');

        $oSolicitud = ORM::factory('Serv_Solicitud')
            ->where('id', '=', $oBoleta->solicitud_id)
            ->find();

        $oServicioG = $oSolicitud->oServicio2();
        $oServicioE = $oSolicitud->oServicioE2();

        $monto = $oServicioG['precio'];
        if (!empty($oServicioE))
            $monto += $oServicioE['precio'];

        $this->template->content = View::factory('caja/detail')
            ->set('oServicioG', $oServicioG)
            ->set('oServicioE', $oServicioE)
            ->set('oSolicitud', $oSolicitud)
            ->set('monto', $monto)
            ->set('oBoleta', $oBoleta);
    }

}
