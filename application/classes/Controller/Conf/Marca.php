<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Conf_Marca extends Controller_Main {

    public function action_index()
    {
        $aMarca = ORM::factory('Conf_Marca')->find_all();

        $this->template->content = View::factory('marca/list')
            ->set('aMarca', $aMarca);
    }

    public function action_new()
    {
        if ($this->request->method() == 'POST')
        {
            $values = $this->request->post();

            $oMarca = ORM::factory('Conf_Marca');
            $oMarca->values($values);
            $oMarca->save();

            $this->redirect('/marca', 'Se registro una nueva marca', 'success');
        }

        $this->response->body(View::factory('marca/new'));
    }

    public function action_edit()
    {
        $oMarca = ORM::factory('Conf_Marca', $this->request->param());

        if (!$oMarca->loaded())
            $this->redirect('/marca', 'Error al obtener información.');

        if ($this->request->method() == 'POST')
        {
            $values = $this->request->post();

            $oMarca->values($values);
            $oMarca->save();

            $this->redirect('/marca', 'Los datos se guardaron satisfactoriamente', 'success');
        }

        $this->response->body(View::factory('marca/edit')
                ->set('oMarca', $oMarca));
    }

}
