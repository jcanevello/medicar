<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Conf_Servicio extends Controller_Main {

    public function action_index()
    {
        $aServicio = ORM::factory('Conf_Servicio')->find_all();

        $this->template->content = View::factory('servicio/list')
            ->set('aServicio', $aServicio);
    }

    public function action_new()
    {
        if ($this->request->method() == 'POST')
        {
            $values = $this->request->post();

            $oServicio = ORM::factory('Conf_Servicio');
            $oServicio->values($values);
            $oServicio->save();

            $this->redirect('/servicio', 'Se registro un nuevo servicio', 'success');
        }

        $this->response->body(View::factory('servicio/new'));
    }

    public function action_edit()
    {
        $oServicio = ORM::factory('Conf_Servicio', $this->request->param());

        if (!$oServicio->loaded())
            $this->redirect('/servicio', 'Error al obtener información.');

        if ($this->request->method() == 'POST')
        {
            $values = $this->request->post();

            $oServicio->values($values);
            $oServicio->save();

            $this->redirect('/servicio', 'Los datos se guardaron satisfactoriamente', 'success');
        }

        $this->response->body(View::factory('servicio/edit')
                ->set('oServicio', $oServicio));
    }

}
