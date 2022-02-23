<?php
require_once ('../app/libraries/Controller.php');

class Users extends Controller {
    private $usersModel;

    public function __construct(){
        $this->usersModel = $this->model('User');
    }

    public function index(){

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
                        redirect('');
                    }else{
                        redirect('');
                    }
                }
            }

        }else{
            //Inicializar los datos
            // cargamos la vista
            $this->view('users/register');    
        }
        
    }
    
    public function login(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $this->view('users/login',[]);

        }elseif($_SERVER['REQUEST_METHOD'] === 'POST'){

            $args = array(
                'email'    => FILTER_SANITIZE_EMAIL,
                'password'     => FILTER_SANITIZE_ENCODED
            );

            $_POST = filter_input_array(INPUT_POST, $args);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err'=>'',
                'password_err'=>''
            ]; 

            $error=false;
            if(empty($data['email'])){
                $data['email_err']= 'El correo no puede estar vacio';
                $error = true;
            }
            if(empty($data['password'])){
                $data['password_err']= 'El password no puede estar vacio';
                $error = true;
            }


            if($error){
                $this->view('users/login',$data);
            }else{

                if($this->usersModel->emailExists($data['email'])){
                   $user = $this->usersModel->checkUser($_POST);
                   if($user){
                       $this->createUserSession($user);
                        redirect('/');
                   }else{
                       $data['password_error']= 'Password incorrecto';
                       $this->view('users/login',$data);
                   }
                    
                }else{
                     $data['email_err']= 'El usuario no existe';
                     $this->view('users/login',$data);
                }

            }
        }
    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);

        session_destroy();

        redirect('user/login');
    }
}
?>