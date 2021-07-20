<?php
session_start();
if(!$_SESSION){
    header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <title>Principal</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <img src="../imagen/logo001.png" alt="respaldo" height="20" width="30"> &nbsp; &nbsp;
      <a class="navbar-brand" href="home.php"> El Sabroso </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php
            if($_SESSION["usuario"]->IdPrivilegio==1){

            
            ?>
            
          <li class="nav-item">
            <a class="nav-link text-white" href="usuario.php">Usuarios</a>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="Productos.php">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="Clientes.php">Clientes</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="fa fa-user"></i> 
              <?php
                echo $_SESSION["usuario"]->Nombres;
              ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <!-- <li><a class="dropdown-item" href="#">Ver Datos</a></li>
              <li><a class="dropdown-item" href="#">Gestionar</a></li>
              <li><a class="dropdown-item" href="#">Privilegios</a></li> -->
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="../controlador/procesosU.php?action=cerrarSesion"> <i class="fa fa-sign-out-alt"></i> Cerrar Sessión</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  


