<?php
include "../modelo/usuarioDao.php";
$opcion=$_REQUEST["action"];

switch ($opcion) {
    case 'cerrarSesion':
        session_destroy();
        header('Location: ../vista/home.php');
        break;
    case 'login':
        $usu = $_POST["txtUsuario"];
        $pass = $_POST["txtPassword"];

        $login = new usuarioDao();
        $log = $login->login($usu,$pass);
        echo json_encode($log);
        break;
    case 'listar':
        $listar = new usuarioDao();
        $listar = $listar->listar();
        echo json_encode($listar);
        break;
    case 'registrar':
        $reg = new usuarioDao();
        if ($_POST["btn"] =="Guardar") {
            $registro = $reg->registrar($_POST);
        }
        if ($_POST["btn"] =="Modificar") {
            $registro = $reg->Moficar($_POST);
        }
        echo json_encode($registro);
        break;
    case 'mostrarID':
        $id = $_POST["id"];
        $reg = new usuarioDao();
        $registro = $reg->mostraID($id);
        echo json_encode($registro);
        break;
    case 'eliminar':
        $id = $_POST["id"];
        $reg = new usuarioDao();
        $registro = $reg->Eliminar($id);
        echo json_encode($registro);
        break;
    default:
        
        break;
}



