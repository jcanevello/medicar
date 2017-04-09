<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Tabla extends ORM {

    protected $_table_name = 'table_table';
    protected $_primary_key = 'id';

    public function status_active()
    {
        $status = $this->where('tabla', '=', 'status')
            ->where('value', '=', 1)
            ->find()
            ->as_array('id');

        return $status['id'];
    }

    public function value($tabla)
    {
        $oTabla = $this->where('tabla', '=', $tabla)
            ->order_by('value', 'DESC')
            ->find();

        return $oTabla->value + 1;
    }

    public function get_status($id)
    {
        return $this->where('tabla', '=', 'status')
                ->where('id', '=', $id)
                ->find()
                ->as_array();
    }

    public function get_tabla($tabla)
    {
        return $this->where('tabla', '=', $tabla)
                ->find_all()
                ->as_array('id', 'name');
    }
    
    public function get_tabla2($tabla)
    {
        return $this->where('tabla', '=', $tabla)
                ->find_all()
                ->as_array('value', 'name');
    }

    public function get_name($id)
    {
        $table = $this->where('id', '=', $id)->find();
        return $table->name;
    }

    public function type_phone_fijo_id()
    {
//        return $this->where('tabla', '=', 'type_phone')
//                ->where('value', '=', 1)
//                ->find()
//                ->as_array('id');
    }

    public function type_phone_cell_id()
    {
//        return $this->where('tabla', '=', 'type_phone')
//                ->where('value', '=', 2)
//                ->find()
//                ->as_array('id');
    }
    
    public function aStatus()
    {
        return $this->where('tabla', '=', 'status')->find_all()->as_array('value', 'name');
    }
    
    public function statusActive()
    {
        $status = ORM::factory('Tabla')->where('tabla', '=', 'status')->and_where('value', '=', 1)->find();
        
        return $status->id;
    }
    
    public function get_name_by_value($tabla, $value)
    {
        $table = $this->where('tabla', '=', $tabla)
                ->and_where('value', '=', $value)
                ->find();
        return $table->name;
    }

}
