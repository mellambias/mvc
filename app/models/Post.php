<?php
class Post{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getPosts(){
        $this->db->query('SELECT * FROM post');
        return $this->db->resultSet();
    }
    
    public function addPost($data){

    }

    public function updatePost($data){

    }

    public function getPostById($id){

    }

    public function deletePost($id){
        
    }

}
?>