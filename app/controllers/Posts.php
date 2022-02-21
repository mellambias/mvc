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

    }

    public function edit($id){

    }

    public function show($id){

    }

    public function delete($id){

    }
}