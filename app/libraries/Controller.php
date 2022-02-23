<?php
/*
Clase Abstracta para controladores
*/
class Controller{

    // devuelve un modelo
    public function model($model){
        if(file_exists('../app/models/'.$model.'.php')){
            require_once ('../app/models/'.$model.'.php');
            return new $model();
        }else{
            throw new Error('El modelo no existe');
        }
    }

    // imprime la vista
    public function view($view, $data=[]){
        if(file_exists('../app/views/'.$view.'.php')){
            require_once('../app/views/'.$view.'.php');
        }else{
            throw new Error('la vista no existe');
        }
    }
}



?>