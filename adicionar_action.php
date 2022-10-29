<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if ($name && $email) {

    if ($usuarioDao->findByEmail($email) === false) {
        $newUser = new Usuario();
        $newUser->setName($name);
        $newUser->setEmail($email);

        $usuarioDao->create( $newUser );

        header("location: index.php");
        exit;
    } else {
        header("location: adicionar.php");
        exit;
    }
} else {
    header("location: adicionar.php");
    exit;
}
