<?php
class Post{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getPosts(){
        $this->db->query('SELECT * FROM posts');
        return $this->db->resultSet();
    }
    
    public function addPost($data){
        $this->db->query('INSERT INTO posts (titulo,contenido)
        VALUES (:titulo, :contenido )');
        $this->db->bind(':titulo',$data['']);
        $this->db->bind(':body',$data['']);

        try{
            $this->db->single();
        }catch(Error $e){
            echo $e->getMessage();
        }

    }

    public function updatePost($data){

    }

    public function getPostById($id){

    }

    public function deletePost($id){
        
    }

}
?>