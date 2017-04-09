<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Serv_Garantia extends ORM {

    protected $_table_name = 'garantia';
    protected $_primary_key = 'solicitud_id';

    public function get_estado()
    {
        return ($this->estado == 1) ? 'Activo' : 'Inactivo';
    }

    public function get_estado_label()
    {
        return ($this->estado == 1) ? 'label-success' : 'label-danger';
    }

}
