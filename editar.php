<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$usuario = false;

$id = filter_input(INPUT_GET, 'id');

if ($id) {

    $usuario = $usuarioDao->findById($id);
}
if($usuario === false){
    header("Location: index.php");
    exit;
}
?>
<h1>Editar Usuario</h1>
<form action="editar_action.php" method="post">
    <input type="hidden" name="id" value="<?= $usuario->getId(); ?>">

    <label>
        Nome:<br>
        <input type="text" name="name" value="<?= $usuario->getName(); ?>">
    </label><br><br>

    <label>
        E-mail:<br>
        <input type="email" name="email" value="<?= $usuario->getEmail(); ?>">
    </label><br><br>

    <input type="submit" value="Editar">

</form>