<?php
require_once ('../app/libraries/Controller.php');

class Posts extends Controller{
    private $postModel;

    public function __construct(){
        $this->postModel = $this->model('Post');
    }

    public function index(...$params){
        $posts = $this->postModel->getPosts();
        // echo "<pre>";
        // print_r($posts);
        // echo "</pre>";
        $this->view('posts/index',$posts);
    }

    public function add(){
        if(isPost()){
            $args = array(
                'title'   => array(FILTER_SANITIZE_SPECIAL_CHARS,FILTER_SANITIZE_ENCODED),
                'body'    => array(FILTER_SANITIZE_SPECIAL_CHARS,FILTER_SANITIZE_ENCODED)
            );

            $_POST = filter_input_array(INPUT_POST, $args);
            

            $userId=isLoggedIn();
            if($userId){
                $data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body'])
                ];
                $error = false;
                if(empty($data['title'])){
                    $data['title_err'] = 'El titulo es obligatorio';
                    $error = true;
                }
                if(empty($data['body'])){
                    $data['body_err'] = 'El body no puede estar vacio';
                    $error = true;
                }
                if ($error){
                    echo $error . '<br>';
                    $this->view('posts/add',$data);
                    exit;
                }
                try{
                    $this->postModel->addPost($userId,$_POST);
                    redirect('posts');
                }catch (Error $e){
                    echo "<pre>";
                    print_r($e);
                    echo "</pre>";
                }
            }else{
                $error['user'] = 'El usuario debe estar registrado';
                $this->view('users/login');
            }
        }else{
            $this->view('posts/add');
        }
    }

    public function edit($idPost){
        if(isPost()){
            $userId=isLoggedIn();
            if($userId){
                $data=[];
                if($this->checkDataPost($data)){
                    // hay errores
                    //echo "<pre>";print_r($data);echo "</pre>";
                    $data['post'] = new stdClass();
                    $data['post']-> title = $_POST['title'];
                    $data['post']-> body = $_POST['body'];
                    $data['post']-> idpost = $idPost;

                    $this->view('posts/edit',$data);
                }else{
                    $this->postModel->updatePost($idPost,$userId,$_POST);
                    redirect('posts');
                }
            }else{
                // blog de otro usuario
                redirect('');
            }
        }else{
            $post = $this->postModel->getPostById($idPost);
            $post->title = $post->titulo;
            $data['post'] = $post;
            $this->view('posts/edit',$data);
        }
    }

    public function show($idPost){
        if(isPost()){
            
        }else{
            $post = $this->postModel->getPostById($idPost);
            $data = [
                'post' => $post
            ];

            $this->view('posts/show',$data);
        }
    }

    public function delete($idPost){
        if(isPost()){
            $userId=isLoggedIn();
            if($userId){
                // el usuario logeado
                $this->postModel->deletePost($idPost,$userId);
            }
        }else{
            redirect('posts');
        }
    }

    private function checkDataPost(&$data){
        $args = array(
                'title'   => array(FILTER_SANITIZE_SPECIAL_CHARS,FILTER_SANITIZE_ENCODED),
                'body'    => array(FILTER_SANITIZE_SPECIAL_CHARS,FILTER_SANITIZE_ENCODED)
            );
        $_POST = filter_input_array(INPUT_POST, $args);
        $data = [
            'title' => trim($_POST['title']),
            'body' => trim($_POST['body'])
        ];
        $error = false;
        if(empty($data['title'])){
            $data['title_err'] = 'El titulo es obligatorio';
            $error = true;
        }
        if(empty($data['body'])){
            $data['body_err'] = 'El body no puede estar vacio';
            $error = true;
        }
        return $error;
    }

    
}