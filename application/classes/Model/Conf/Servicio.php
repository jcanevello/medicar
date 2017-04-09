<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Conf_Servicio extends ORM {

    protected $_table_name = 'servicio';
    protected $_primary_key = 'id';

    public function get_tipo()
    {
        return ($this->tipo == 1) ? 'General' : 'Especial';
    }

    public function get_estado()
    {
        return ($this->estado == 1) ? 'Activo' : 'Inactivo';
    }

    public function get_estado_label()
    {
        return 'label-' . (($this->estado == 1) ? 'success' : 'danger');
    }

}
