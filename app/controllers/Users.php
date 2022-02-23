<?php
require_once ('../app/libraries/Controller.php');

class Users extends Controller {
    private $usersModel;

    public function __construct(){
        $this->usersModel = $this->model('User');
    }

    public function register(){
        // si llegamos por get -> mostramos vista
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // si llemagos por post -> procesamos el formulario
            //Sanitizar los datos
            $args = array(
                'name'   => FILTER_SANITIZE_ENCODED,
                'email'    => FILTER_SANITIZE_EMAIL,
                'password'     => FILTER_SANITIZE_ENCODED,
                'confirm_password' => FILTER_SANITIZE_ENCODED
            );
            $_POST = filter_input_array(INPUT_POST, $args);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err'=>'',
                'email_err'=>'',
                'password_err'=>'',
                'confirm_password_err'=>''
            ];

            $error = false;
            //Validar email
            if(empty($data['email'])){
                $data['email_error'] = 'El email no puede estar vacio';
                $error=true;
            }
            //Validar name
            if(empty($data['name'])){
                $data['name_error'] = 'El name no puede estar vacio. ';
                $error=true;
            }
            //Validar password
            if(empty($data['password'])){
                $data['password_error'] = 'El password no puede estar vacio. ';
                $error=true;
            }elseif (mb_strlen($data['password']) < 8){
                $data['password_error'] = 'El password tiene que tener mas de 8 caracteres';
                $error=true;
            }
            //Validar confirm_password
            if(empty($data['confirm_password'])){
                $data['confirm_password_error'] = 'El password no puede estar vacio. ';
                $error=true;
            }elseif($data['confirm_password']!=$data['password']){
                $data['confirm_password_error'] = 'No coincide';
                $error=true;
            }
            // si existen errores => cargamos la vista

            if ($error){
                $this->view('users/register',$data);
            }else{
                if($this->usersModel->emailExists($data['email'])){
                    $data['email_error']='Ya se han registrado con este correo';
                    $this->view('users/register',$data);
                }else{
                    if( $this->usersModel->register($_POST) ){
                        $this->view('pages/');
                    }else{
                        $this->view('pages/');
                    }
                }
            }

        }else{
            //Inicializar los datos
            // cargamos la vista
            $this->view('users/register');    
        }
        
    }
    
}
?>