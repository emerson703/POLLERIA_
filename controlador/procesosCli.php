<?php
include "../modelo/clienteDao.php";
$opcion=$_REQUEST["action"];

switch ($opcion) {
    case 'cerrarSesion':
        session_destroy();
        header('Location: ../vista/home.php');
        break;
    case 'listar':
        $listar = new clienteDao();
        $listar = $listar->listar();
        echo json_encode($listar);
        break;
    case 'registrar':
        $reg = new clienteDao();
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
        $reg = new clienteDao();
        $registro = $reg->mostraID($id);
        echo json_encode($registro);
        break;
    case 'eliminar':
        $id = $_POST["id"];
        $reg = new clienteDao();
        $registro = $reg->Eliminar($id);
        echo json_encode($registro);
        break;
    default:
        
        break;
}