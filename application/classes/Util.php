<?php

class Util {

    public static function get_month_number($month)
    {
        switch ($month)
        {
            case 'Enero' :
                return '01';
                break;
            case 'Febrero' :
                return '02';
                break;
            case 'Marzo' :
                return '03';
                break;
            case 'Abril' :
                return '04';
                break;
            case 'Mayo' :
                return '05';
                break;
            case 'Junio' :
                return '06';
                break;
            case 'Julio' :
                return '07';
                break;
            case 'Agosto' :
                return '08';
                break;
            case 'Septiembre' :
                return '09';
                break;
            case 'Octubre' :
                return '10';
                break;
            case 'Noviembre' :
                return '11';
                break;
            case 'Diciembre' :
                return '12';
                break;
        }
    }

    public static function get_month_name($month)
    {
        switch ($month)
        {
            case '01' :
                return 'Enero';
                break;
            case '02' :
                return 'Febrero';
                break;
            case '03' :
                return 'Marzo';
                break;
            case '04' :
                return 'Abril';
                break;
            case '05' :
                return 'Mayo';
                break;
            case '06' :
                return 'Junio';
                break;
            case '07' :
                return 'Julio';
                break;
            case '08' :
                return 'Agosto';
                break;
            case '09' :
                return 'Septiembre';
                break;
            case '10' :
                return 'Octubre';
                break;
            case '11' :
                return 'Noviembre';
                break;
            case '12' :
                return 'Diciembre';
                break;
        }
    }

    public static function get_day_name($day)
    {
        switch ($day)
        {
            case 1 :
                return 'Lunes';
                break;
            case 2 :
                return 'Martes';
                break;
            case 3 :
                return 'Miércoles';
                break;
            case 4 :
                return 'Jueves';
                break;
            case 5 :
                return 'Viernes';
                break;
            case 6 :
                return 'Sábado';
                break;
            case 7 :
                return 'Domingo';
                break;
        }
    }

    public static function date_format($date)
    {
        $day = explode('/', $date);

        return ($day[2] . ' de ' . $day[1] . ' de ' . $day[0]);
    }

    public static function date_format_save($date)
    {
        $day = explode('/', $date);

        return ($day[0] . '-' . Util::get_month_number($day[1]) . '-' . $day[2]);
    }

    public static function date_format_text($date)
    {
        if(empty($date))
            return NULL;
        
        return Util::get_day_name(date('N', strtotime($date))) . ', ' . date(date('d', strtotime($date))) . ' de ' . Util::get_month_name(date(date('m', strtotime($date)))) . ' del ' . date(date('Y', strtotime($date)));
    }

    public static function msj_error($errors)
    {
        $msj = NULL;
        $errores = (object) $errors;
        foreach ($errores as $value)
        {
            $msj .= $value . '<br>';
        }

        return $msj;
    }

    public static function intervalo_dias($inicio, $fin)
    {
        $intervalo = date_diff(date_create($fin), date_create($inicio));
        $numero_dias = $intervalo->format('%a');

        return $numero_dias;
    }

    public static function sumar_dias($fecha, $dias)
    {
        $oFecha = New DateTime($fecha);
        $oFecha->modify('+' . $dias . ' day');

        return $oFecha->format('Y-m-d');
    }

    /*
     * -1 => f1<f2
     *  0 => f1=f2
     *  1 => f1>f2
     */

    public static function comparar_fechas($f_1, $f_2)
    {
        $str_f1 = strtotime($f_1);
        $str_f2 = strtotime($f_1);

        if ($f_1 < $f_2)
            return -1;
        if ($f_1 == $f_2)
            return 0;
        if ($f_1 > $f_2)
            return 1;
    }

    public static function dia_mes_ano($date)
    {
        return date('d-m-Y', strtotime($date));
    }

    public static function ano_mes_dia($date)
    {
        return date('Y-m-d', strtotime($date));
    }

    public static function redirect($url, $msj = NULL, $tipo = NULL)
    {
        if (!Request::current()->is_ajax())
            Controller_Main::redirect($url, $msj, $tipo);
        else
            die($msj);
    }

    public static function minutosDiferencia($f_inicio, $f_final)
    {
        $minutos = (strtotime($f_inicio) - strtotime($f_final)) / 60;
        $minutos = abs($minutos);
        $minutos = round($minutos, 1);

        return $minutos;
    }

    public static function operarMin($fecha, $cantidad)
    {
        $fecha = date("Y-m-d H:i:s");
        $fecha = strtotime($cantidad . ' minute', strtotime($fecha));

        return date("Y-m-d H:i:s", $fecha);
    }

    public static function getRestriccion($codigo)
    {
        return Kohana::message('restricciones', $codigo);
    }

    public static function getRestriccionesAllText($restricciones)
    {
        $respuesta = NULL;

        foreach ($restricciones as $value)
        {
            $resul = Util::getRestriccion($value);
            $respuesta .= $resul['msj'] . '<br>';
        }

        return $respuesta;
    }

    public static function encrypt($data)
    {
        return sha1(md5($data . Cookie::$salt));
    }

    public static function fechaActualVarDías($variacion)
    {
        $fecha = date("Y-m-d");
        $fecha = strtotime($variacion . ' day', strtotime($fecha));

        return date("Y-m-d", $fecha);
    }

    public static function validarFecha($fecha)
    {
        $dia = date('d', strtotime($fecha));
        $mes = date('m', strtotime($fecha));
        $ano = date('Y', strtotime($fecha));

        return checkdate($mes, $dia, $ano);
    }

}
