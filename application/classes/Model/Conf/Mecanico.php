<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Conf_Mecanico extends ORM {

    protected $_table_name = 'mecanico';
    protected $_primary_key = 'id';

    public function get_estado()
    {
        return ($this->estado == 1) ? 'Activo' : 'Inactivo';
    }

    public function get_estado_label()
    {
        return 'label-' . (($this->estado == 1) ? 'success' : 'danger');
    }

    public function fullName()
    {
        return $this->nombre . ' ' . $this->apellidos;
    }

}
