<?php
class Usuario{   // classe do usuario 
    private $id;
    private $name;
    private $email;

    public function getId(){
        return $this->id;
    }

    public function setId($i){
        $this->id = trim($i);
    }

    public function getName(){
        return $this->name;
    }

    public function setName($n){
        $this->name = ucwords(trim($n));
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($e){
        $this->email = strtolower(trim($e));
    }

}

interface UsuarioDAO { // interface de implementação do DAO
    public function create(Usuario $user);
    public function findAll();
    public function findByEmail($email);
    public function findById($id);
    public function update(Usuario $user);
    public function delete($id);
}