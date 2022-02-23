<?php
require_once ('../app/libraries/Controller.php');

class Posts extends Controller{
    private $postModel;

    public function __construct(){
        $this->postModel = $this->model('Post');
    }

    public function index(...$params){
        $posts = $this->postModel->getPosts();
        $data = ['title' => 'Mis Posts', 'posts'=>$posts];
        $this->view('posts/index',$data);
    }

    public function add(){
        if(isPost()){
            $args = array(
                'titulo'   => FILTER_SANITIZE_ENCODED,
                'body'     => array(FILTER_SANITIZE_SPECIAL_CHARS,FILTER_SANITIZE_ENCODED)
            );

            $_POST = filter_input_array(INPUT_POST, $args);
            $this->postModel->add($_POST);
        }else{
            $this->view('posts/add');
        }
    }

    public function edit($id){
        if(isPost()){
            
        }else{
            $this->view('posts/edit');
        }
    }

    public function show($id){
        if(isPost()){
            
        }else{
            $this->view('posts/show');
        }
    }

    public function delete($id){
        if(isPost()){
            
        }else{
            redirect('posts');
        }
    }
}