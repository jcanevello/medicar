<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Conf_Mecanico extends Controller_Main {

    public function action_index()
    {
        $aMecanico = ORM::factory('Conf_Mecanico')->find_all();

        $this->template->content = View::factory('mecanico/list')
            ->set('aMecanico', $aMecanico);
    }

    public function action_new()
    {
        if ($this->request->method() == 'POST')
        {
            $values = $this->request->post();

            $rMecanico = ORM::factory('Conf_Mecanico')
                ->where('dni', '=', $values['dni'])
                ->find();

            if ($rMecanico->loaded())
                $this->redirect('/mecanico', 'El DNI ya se encuentra registrado', 'warning');

            $oMecanico = ORM::factory('Conf_Mecanico');
            $oMecanico->values($values);
            $oMecanico->created_at = date('Y-m-d');
            $oMecanico->save();

            $this->redirect('/mecanico', 'Se registro un nuevo mecánico', 'success');
        }

        $this->response->body(View::factory('mecanico/new'));
    }

    public function action_edit()
    {
        $oMecanico = ORM::factory('Conf_Mecanico', $this->request->param());

        if (!$oMecanico->loaded())
            $this->redirect('/mecanico', 'Error al obtener información.');

        if ($this->request->method() == 'POST')
        {
            $values = $this->request->post();

            $rMecanico = ORM::factory('Conf_Mecanico')
                ->where('dni', '=', $values['dni'])
                ->and_where('id', '<>', $this->request->param())
                ->find();

            if ($rMecanico->loaded())
                $this->redirect('/mecanico', 'El DNI ya se encuentra registrado', 'warning');

            $oMecanico->values($values);
            $oMecanico->created_at = date('Y-m-d');
            $oMecanico->save();

            $this->redirect('/mecanico', 'Los datos se guardaron satisfactoriamente', 'success');
        }

        $this->response->body(View::factory('mecanico/edit')
                ->set('oMecanico', $oMecanico));
    }

}
