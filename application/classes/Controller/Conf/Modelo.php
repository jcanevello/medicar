<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Conf_Modelo extends Controller_Main {

    public function action_list()
    {
        $oMarca = ORM::factory('Conf_Marca', $this->request->param());

        if (!$oMarca->loaded())
            $this->redirect('/marca', 'Información no encontrada.');

        $aModelo = ORM::factory('Conf_Modelo')
            ->where('marca_id', '=', $oMarca->id)
            ->find_all();

        $this->template->content = View::factory('modelo/list')
            ->set('oMarca', $oMarca)
            ->set('aModelo', $aModelo);
    }

    public function action_new()
    {
        $oMarca = ORM::factory('Conf_Marca', $this->request->param());

        if (!$oMarca->loaded())
            $this->redirect('/marca', 'Información no encontrada.');

        if ($this->request->method() == 'POST')
        {
            $values = $this->request->post();

            $oModelo = ORM::factory('Conf_Modelo');
            $oModelo->values($values);
            $oModelo->marca_id = $oMarca->id;
            $oModelo->save();

            $this->redirect('/modelo/list/' . $oMarca->id, 'Se registro un nuevo modelo', 'success');
        }

        $this->response->body(View::factory('modelo/new')
                ->set('oMarca', $oMarca));
    }

    public function action_edit()
    {
        $oModelo = ORM::factory('Conf_Modelo', $this->request->param());

        if (!$oModelo->loaded())
            $this->redirect('/modelo', 'Error al obtener información.');

        if ($this->request->method() == 'POST')
        {
            $values = $this->request->post();

            $oModelo->values($values);
            $oModelo->save();

            $oMarca = ORM::factory('Conf_Marca', $oModelo->marca_id);

            $this->redirect('/modelo/list/' . $oMarca->id, 'Los datos se guardaron satisfactoriamente', 'success');
        }

        $this->response->body(View::factory('modelo/edit')
                ->set('oModelo', $oModelo));
    }

}
