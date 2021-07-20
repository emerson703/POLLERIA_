<?php
session_start();

include "conexion.php";
class usuarioDao extends ConexionDB{
    private $conex;
    public function __construct() {
        $this->conex = new ConexionDB();
        $this->conex = $this->conex->Conectar();
    }
    public function login($user,$pass){
        $var = "SELECT * FROM tbusuarios where Usuario='$user' and Clave='$pass'";
        $resultado = $this->conex->prepare($var);
        $resultado->execute();
        if($resultado->rowCount()>0){
            
            $datos = $resultado->fetch(PDO::FETCH_OBJ);
            $arrayName = array('estado' =>"ok" ,"datos"=>$datos);
            $_SESSION["usuario"]=$datos;
        }
        else{
            $arrayName = array('estado' =>"no" ,"datos"=>"");
        }
        return $arrayName;
    }
    public function mostraID($id){
        $var = "SELECT * FROM tbusuarios where IdUsuario=".$id;
        $resultado = $this->conex->prepare($var);
        $resultado->execute();
        if($resultado->rowCount()>0){
            $datos = $resultado->fetch(PDO::FETCH_OBJ);
            $arrayName = array('estado' =>"ok" ,"datos"=>$datos);
        }
        else{
            $arrayName = array('estado' =>"no" ,"datos"=>"");
        }
        return $arrayName;
    }
    public function listar(){
        $var2 = "SELECT * FROM tbusuarios";
        $resultado=$this->conex->prepare($var2);
        $resultado->execute();
        if($resultado->rowCount()>0){
            
            $datos = $resultado->fetchAll(PDO::FETCH_OBJ);
            $arrayName = array('estado' =>"ok" ,"datos"=>$datos);
        }
        else{
            $arrayName = array('estado' =>"no" ,"datos"=>"");
        }
        return $arrayName;

    }
    public function registrar($data){
        
        $var = "INSERT INTO tbusuarios (Dni, Nombres, Apellidos, Direccion, Telefono, FechaIngreso, Usuario, Clave, IdPrivilegio, Estado)
        VALUES (:dni, :nom, :ape, :dir, :tel, :fec, :usu, :cla, :idb, :est)";
         $resultado = $this->conex->prepare($var);
         $resultado->bindValue(":dni",$data["txtDni"]);
         $resultado->bindValue(":nom",$data["txtNombres"]);
         $resultado->bindValue(":ape",$data["txtApellidos"]);
         $resultado->bindValue(":dir",$data["txtDireccion"]);
         $resultado->bindValue(":tel",$data["txtTelefono"]);
         $resultado->bindValue(":fec",$data["txtFechaI"]);
         $resultado->bindValue(":usu",$data["txtCorreo"]);
         $resultado->bindValue(":cla",$data["txtClave"]);
         $resultado->bindValue(":idb",$data["cboTipo"]);
         $resultado->bindValue(":est",$data["cboEstado"]);
         $resultado->execute();
         $ultimoID = $this->conex->lastInsertId();
         if($ultimoID > 0){
             $arrayName = array('estado' =>"ok" ,"datos"=>"Usuario Registrado");
         }
         else{
             $arrayName = array('estado' =>"no" ,"datos"=>"Usuario no se registro");
         }
         return $arrayName;
    }
    public function Moficar($data){
        
        $var = "UPDATE tbusuarios SET Dni=:dni, Nombres=:nom, Apellidos=:ape, Direccion=:dir, Telefono=:tel, FechaIngreso=:fec, Usuario=:usu, Clave=:cla, IdPrivilegio=:idb, Estado=:est WHERE IdUsuario=:id";
         $resultado = $this->conex->prepare($var);
         $resultado->bindValue(":dni",$data["txtDni"]);
         $resultado->bindValue(":nom",$data["txtNombres"]);
         $resultado->bindValue(":ape",$data["txtApellidos"]);
         $resultado->bindValue(":dir",$data["txtDireccion"]);
         $resultado->bindValue(":tel",$data["txtTelefono"]);
         $resultado->bindValue(":fec",$data["txtFechaI"]);
         $resultado->bindValue(":usu",$data["txtCorreo"]);
         $resultado->bindValue(":cla",$data["txtClave"]);
         $resultado->bindValue(":idb",$data["cboTipo"]);
         $resultado->bindValue(":est",$data["cboEstado"]);
         $resultado->bindValue(":id",$data["txtID"]);
         $resultado->execute();
        //  $ultimoID = $this->conex->lastInsertId();
         if($resultado->execute()){
             $arrayName = array('estado' =>"ok" ,"datos"=>"Usuario Modificado");
         }
         else{
             $arrayName = array('estado' =>"no" ,"datos"=>"Usuario No se pudo Modificar");
         }
         return $arrayName;
    }
    public function Eliminar($id){
        $var = "DELETE FROM tbusuarios  WHERE IdUsuario=".$id;
         $resultado = $this->conex->prepare($var);
         if($resultado->execute()){
             $arrayName = array('estado' =>"ok" ,"datos"=>"Usuario Eliminado");
         }
         else{
             $arrayName = array('estado' =>"no" ,"datos"=>"Usuario No se pudo Eliminar");
         }
         return $arrayName;
    }

}

?>