<?php
class User{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getUsers(){
        $this->db->query('SELECT * FROM users');
        return $this->db->resultSet();
    }
    
    public function register($data){
        $this->db->query('INSERT INTO users (name,email,password)
        VALUES(:name,:email,:password)');

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        return $this->db->execute();

    }

    public function emailExists($email){
        $this->db->query('SELECT * FROM users 
        WHERE email = :email');
        $this->db->bind(':email', $email);
        $this->db->execute();
        return $this->db->rowCount()>0;
    }

    public function checkUser($data){
        $this->db->query('SELECT * FROM users 
        WHERE email = :email');
        $this->db->bind(':email', $data['email']);
        $user=$this->db->single();
        return password_verify(trim($data['password']), $user->password) ? $user : false;
    }
}
?>