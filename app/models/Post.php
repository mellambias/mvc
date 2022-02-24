<?php
class Post{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getPosts(){
        $this->db->query('SELECT posts.idpost, posts.titulo, posts.body, posts.postCreated, users.name
        FROM posts, users 
        WHERE posts.iduser = users.id
        ORDER BY postCreated');

        return $this->db->resultSet();
    }
    
    public function addPost($userId,$data){
        $this->db->query('INSERT INTO posts (titulo, body, iduser)
        VALUES (:titulo, :body, :iduser )');

        $this->db->bind(':titulo', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':iduser', intval($userId));

        try{
            $this->db->execute();
        }catch(Error $e){
            echo $e->getMessage();
        }

    }

    public function updatePost($idPost,$userId,$data){
        $this->db->query('UPDATE posts 
        SET titulo = :titulo, body = :body
        WHERE idpost = :idpost and iduser = :userId');

        $this->db->bind(':titulo', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':idpost', intval($idPost));
        $this->db->bind(':userId', intval($userId));

        $this->db->execute();
    }

    public function getPostById($idPost){
        $this->db->query('SELECT posts.*, users.name 
        FROM posts, users
        WHERE idpost = :idpost
        AND
        posts.iduser = users.id');

        $this->db->bind(':idpost', intval($idPost));
        return $this->db->single();

    }

    public function deletePost($idPost, $iduser){
        $this->db->query('DELETE FROM posts WHERE idpost=:idpost and iduser=:iduser');
        $this->db->bind(':idpost', intval($idPost));
        $this->db->bind(':iduser', intval($iduser));

        $this->db->execute();
    }

}
?>