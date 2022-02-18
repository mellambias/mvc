<?php
/*
App Class Core
Crear las URL y cargar el controller correspondiente
*/
class Core{
    private $currentController = 'Pages';
    private $currentMethod = 'index';
    private $params = [];

    public function __construct(){
        $url = $this->getUrl();
        if(file_exist('../app/controllers/'.ucwords($url[0]).'php')){
            $this->currentController = ucwords($url[0]);
        }
        require_once '../app/controllers/'.ucwords($url[0]).'php';

        //instanciar la clase del controlador
        $this->$currentController = new $this->$currentController();
    }

    private function getUrl(){
        if(isset($_GET['url'])){
          $uri=rtrim($_GET['url'],'/');
          $uri=filter_var($uri,FILTER_SANITIZE_URL);
          $uri = explode("/",$uri);
          return $uri;
        }
        return [$this->currentController];
    }
}
?>