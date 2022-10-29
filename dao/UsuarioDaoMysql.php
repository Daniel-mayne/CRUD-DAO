<?php
require_once 'models/Usuario.php';

class UsuarioDaoMysql implements UsuarioDAO {
    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }

    public function create(Usuario $user){
        $sql = $this->pdo->prepare("INSERT INTO usuarios (name, email) VALUES (:name, :email)");
        $sql->bindValue(':name', $user->getName());
        $sql->bindValue(':email', $user->getEmail());
        $sql->execute();

        $user->setId( $this->pdo->lastInsertId() );
        return $user;
    }

    public function findAll(){
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM usuarios");
        if($sql->rowCount() > 0){
            $data = $sql->fetchAll();

            foreach($data as $item){
                $user = new Usuario();
                $user->setId($item['id']);
                $user->setName($item['name']);
                $user->setEmail($item['email']);

                $array[] = $user;
            }
        }
         return $array;
    }

    public function findByEmail($email){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch();

            $user = new Usuario();
            $user->setId($data['id']);
            $user->setName($data['name']);
            $user->setEmail($data['email']);

            return $user;
        } else {
            return false;
        }
    }

    public function findById($id){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch();

            $user = new Usuario();
            $user->setId($data['id']);
            $user->setName($data['name']);
            $user->setEmail($data['email']);

            return $user;
        } else {
            return false;
        }

    }

    public function update(Usuario $user){
        $sql = $this->pdo->prepare("UPDATE usuarios SET name = :name, email = :email WHERE id = :id");
        $sql->bindValue(':name', $user->getName());
        $sql->bindValue(':email', $user->getEmail());
        $sql->bindValue(':id', $user->getId());
        $sql->execute();
        return true;
    }

    public function delete($id){
        $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}
