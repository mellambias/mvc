<?php
require_once ('../app/libraries/Controller.php');

class Pages extends Controller{
    public function __construct(){
    }

    public function index(...$params){
        $data = ['saluda' => 'hola'];
        $this->view('pages/index',$data);
    }

    public function about(){
        $this->view('pages/about');
    }

    public function readOne($id){
        echo 'Implementa el readOne';
    }
}