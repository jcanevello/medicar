<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Serv_Vehiculo extends Controller_Main {

    public function action_new()
    {
        if ($this->request->method() == 'POST')
        {
            $values = $this->request->post();

            $placa = trim($values['parte1']) . trim($values['parte2']);

            if (strlen($placa) != 6)
                $this->redirect('/vehiculo/new', 'La placa debe tener 6 valores');

            if (!preg_match('/^[0-9a-zA-Z]+$/', $placa))
                $this->redirect('/vehiculo/new', 'Ingrese una placa válida.');

            if (strlen($values['anio']) != 4)
                $this->redirect('/vehiculo/new', 'El año debe tener 4 dígitos');
            if (!ctype_digit($values['anio']))
                $this->redirect('/vehiculo/new', 'El año debe contener solo dígitos');
            if ($values['anio'] > date('Y'))
                $this->redirect('/vehiculo/new', 'El año ingresado debe ser menor al año actual');

            $rVehiculo = ORM::factory('Serv_Vehiculo')
                ->where('placa', '=', $placa)
                ->find();

            if ($rVehiculo->loaded())
                $this->redirect('/vehiculo/new', 'La placa ya se encuentra registrada');

            $oVehiculo = ORM::factory('Serv_Vehiculo');
            $oVehiculo->values($values);
            $oVehiculo->placa = $placa;
            $oVehiculo->created_at = date('Y-m-d');
            $oVehiculo->save();

            $this->redirect('/vehiculo/detail/' . $oVehiculo->placa, 'Los datos han sido guardados', 'success');
        }

        $aMarca = ORM::factory('Conf_Marca')
            ->find_all()
            ->as_array('id', 'nombre');

        $this->template->content = View::factory('vehiculo/new')
            ->set('aMarca', $aMarca);
    }

    public function action_detail()
    {
        $oVehiculo = ORM::factory('Serv_Vehiculo')
            ->where('placa', '=', $this->request->param())
            ->find();

        if (!$oVehiculo->loaded())
            $this->redirect('/', 'El vehículo solicitado no se encuentra');

        $aSolicitud = ORM::factory('Serv_Solicitud')
            ->where('placa', '=', $oVehiculo->placa)
            ->order_by('created_at', 'DESC')
            ->find_all();

        $this->template->content = View::factory('vehiculo/detail')
            ->set('oVehiculo', $oVehiculo)
            ->set('aSolicitud', $aSolicitud);
    }

    public function action_edit()
    {
        $oVehiculo = ORM::factory('Serv_Vehiculo')
            ->where('placa', '=', $this->request->param())
            ->find();

        if (!$oVehiculo->loaded())
            $this->redirect('/', 'El vehículo solicitado no se encuentra');

        if ($this->request->method() == 'POST')
        {
            $values = $this->request->post();

            if (strlen($values['anio']) != 4)
                $this->redirect('/vehiculo/edit/' . $oVehiculo->placa, 'El año debe tener 4 dígitos');
            if (!ctype_digit($values['anio']))
                $this->redirect('/vehiculo/edit/' . $oVehiculo->placa, 'El año debe contener solo dígitos');
            if ($values['anio'] > date('Y'))
                $this->redirect('/vehiculo/edit/' . $oVehiculo->placa, 'El año ingresado debe ser menor al año actual');

            $oVehiculo->values($values);
            $oVehiculo->save();

            $this->redirect('/vehiculo/detail/' . $oVehiculo->placa, 'Los datos han sido guardados', 'success');
        }

        $aMarca = ORM::factory('Conf_Marca')
            ->find_all()
            ->as_array('id', 'nombre');

        $this->template->content = View::factory('vehiculo/edit')
            ->set('oVehiculo', $oVehiculo)
            ->set('aMarca', $aMarca);
    }

    public function action_get_modelo()
    {
        $id = $this->request->post('id') ? $this->request->post('id') : 0;

        if (!$this->request->is_ajax())
            $result = array('status' => 'ERROR');
        else
        {
            $resultModelo = DB::select('id', array(DB::expr('CONCAT(nombre, " " ,version)'), 'nombre'))
                ->from('modelo')
                ->where('marca_id', '=', $id)
                ->execute();

            $aModelo = null;
            foreach ($resultModelo as $value)
            {
                $aModelo[$value['id']] = $value['nombre'];
            }

            $result = array('status' => 'OK', 'data' => $aModelo);
        }

        $this->response->body(json_encode($result));
    }

    public function action_search()
    {
        if ($this->request->method() == 'POST')
        {
            $oVehiculo = ORM::factory('Serv_Vehiculo')
                ->where('placa', '=', $this->request->post('placa'))
                ->find();

            if ($oVehiculo->loaded())
                $this->redirect('/vehiculo/detail/' . $oVehiculo->placa);
        }

        $this->template->content = View::factory('vehiculo/search')
            ->set('placa', $this->request->post('placa'));
    }

}
