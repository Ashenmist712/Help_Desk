<?php
session_start();

if (isset($_POST['login']) && isset($_POST['password'])) {

    $usuario = $_POST['login'];
    $password = sha1($_POST['password']);

    include '../../../clases/Usuarios.php';
    $Usuarios = new Usuarios();

    echo $Usuarios->loginUsuario($usuario, $password);
} else {
    echo 0;
}
