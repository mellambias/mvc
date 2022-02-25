<?php

function getPost($clave,&$error=null, $filter= FILTER_DEFAULT){
    /**
     * recupera y sanitiza la entrada, en caso de error usa el array error
     */
    if(empty($_POST[$clave])){
        $error[$clave.'_err'] = 'El campo '.$clave.' no puede estar vacio';
        return $_POST[$clave];
    }
    if (is_Int($filter)){
        $result = filter_var(trim($_POST[$clave]), $filter);
        if($result){
            return $_POST[$clave] = $result;
        }else{
            $error[$clave.'_err'] = 'El campo '.$clave.' no cumple el filtro';
        }
    }else{
        foreach($filter as $filtro){
            $result = filter_var(trim($_POST[$clave]), $filtro);
            if($result){
                $_POST[$clave] = $result;
            } else{
                $error[$clave.'_err'] = 'El campo '.$clave.' no cumple el filtro';
                break;
            }
        }
        return $_POST[$clave];
    }
}