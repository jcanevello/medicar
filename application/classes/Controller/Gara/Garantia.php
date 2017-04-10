<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Gara_Garantia extends Controller_Main {

    public function action_buscar()
    {
        $mensaje = NULL;
        if ($this->request->method() == 'POST')
        {
            $oSolicitud = ORM::factory('Serv_Solicitud')
                ->where('id', '=', $this->request->post('num_solicitud'))
                ->find();

            if ($oSolicitud->loaded())
                $this->redirect('/solicitud/detail/' . $oSolicitud->id);

            $mensaje = 'No se ha encontrado la solicitud indicada';
        }

        $this->template->content = View::factory('garantia/buscar')
            ->set('mensaje', $mensaje);
    }

    public function action_nuevo()
    {
        $oSolicitud = ORM::factory('Serv_Solicitud')
            ->where('id', '=', $this->request->param('id'))
            ->find();

        if (!$oSolicitud->loaded())
            Util::redirect('/', 'No se ha encontrado la solicitud');

        $oGarantia = ORM::factory('Serv_Garantia')
            ->where('solicitud_id', '=', $oSolicitud->id)
            ->find();

        if (!$oGarantia->loaded())
            Util::redirect('/solicitud/detail/' . $oSolicitud->id, 'La solicitud no tiene registrado la garantía');

        if ($oGarantia->estado == 2)
            Util::redirect('/solicitud/detail/' . $oSolicitud->id, 'La garantía ya venció');

        if ($this->request->method() == 'POST')
        {
            $oTecnico = ORM::factory('Conf_Mecanico')
                ->where('id', ' = ', $this->request->post('tecnico_id'))
                ->find();

            if (!$oTecnico->loaded())
                $this->redirect('/solicitud/detail/' . $oSolicitud->id, 'Hubo un problema con el registro.');

            $oGarantiamecanico = ORM::factory('Serv_Garantiamecanico');
            $oGarantiamecanico->garantia_id = $oGarantia->solicitud_id;
            $oGarantiamecanico->mecanico_id = $oTecnico->id;
            $oGarantiamecanico->created_at = date('y-m-d');
            $oGarantiamecanico->save();

            $this->redirect('/solicitud/detail/' . $oSolicitud->id, 'El mantenimiento se ha registrado', 'success');
        }

        $aTecnico = ORM::factory('Conf_Mecanico')
            ->where('estado', ' = ', 1)
            ->find_all();

        $this->response->body(View::factory('garantia/nuevo')
                ->set('oSolicitud', $oSolicitud)
                ->set('aTecnico', $aTecnico));
    }

    public function action_cancelar()
    {
        $oGarantiaM = ORM::factory('Serv_Garantiamecanico')
            ->where('id', '=', $this->request->param('id'))
            ->find();

        if (!$oGarantiaM->loaded())
            Util::redirect('/', 'Error al obtener información');

        if ($this->request->method() == 'POST')
        {
            $oGarantiaM->estado = 3;
            $oGarantiaM->save();

            $this->redirect('/solicitud/detail/' . $oGarantiaM->garantia_id, 'se cambió la información', 'success');
        }

        $this->response->body(View::factory('garantia/cancelar_trabajo')
                ->set('oGarantiaM', $oGarantiaM));
    }

}
