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
        if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
            $this->currentController = ucwords($url[0]);
        }
        require_once '../app/controllers/'.$this->currentController.'.php';

        //instanciar la clase del controlador dinamicamente
        $this->currentController = new $this->currentController();

        // Establecer el metodo
        if(isset($url[1])){
            if(method_exists($this->currentController,$url[1])){
                $this->currentMethod = $url[1];
            }
        }

        // recoger los parametros
        $this->params = array_slice($url,2);
        try{
            call_user_func_array(array($this->currentController,$this->currentMethod),$this->params);
        }catch(Error $e){
            echo '<div style="color:red"><h1>'.$e->getMessage().'</h1><pre>';
            print_r($e);
            echo '</pre></div><br>';
        }
        
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