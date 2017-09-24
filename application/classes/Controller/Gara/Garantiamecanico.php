<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Gara_Garantiamecanico extends Controller_Main {

    public function action_terminar()
    {
        $oGarantiaM = ORM::factory('Serv_Garantiamecanico')
            ->where('id', '=', $this->request->param('id'))
            ->find();

        if (!$oGarantiaM->loaded())
            Util::redirect('/', 'No se encontro información del trabajo');

        if ($this->request->method() == 'POST')
        {
            $oGarantiaM->estado = 2;
            $oGarantiaM->save();

            $this->redirect('/boleta/buscarservicios', 'Se ha terminado el trabajo de garantía', 'success');
        }

        $this->response->body(View::factory('garantiam/terminar')
                ->set('oGarantiaM', $oGarantiaM));
    }

}
