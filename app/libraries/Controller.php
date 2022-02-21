<?php
/*
Clase Abstracta para controladores
*/
class Controller{

    // devuelve un modelo
    public function model($model){
        require_once ('../app/models/'.$model.'.php');
        return new $model();
    }

    // imprime la vista
    public function view($view, $data=[]){
        require_once('../app/views/'.$view.'.php');
    }

    // CRUD 
    public function create(...$params){
        throw new Error('función create no implementada');
    }
    public function readOne($id){
        throw new Error('función readOne no implementada');
    }
    public function readAll(){
        throw new Error('función readAll no implementada');
    }
    public function update($id,...$params){
        throw new Error('función update no implementada');
    }
    public function delete($id){
        throw new Error('función delete no implementada');
    }


}



?>