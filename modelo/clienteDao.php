<?php
session_start();

include "conexion.php";
class clienteDao extends ConexionDB{
    private $conex;
    public function __construct() {
        $this->conex = new ConexionDB();
        $this->conex = $this->conex->Conectar();
    }
    public function mostraID($id){
        $var = "SELECT * FROM tbclientes where IdCliente=".$id;
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
        $var2 = "SELECT * FROM tbclientes";
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
        
        $var = "INSERT INTO tbclientes (Nombres, Apellidos, Dni, Direccion, Telefono, Estado)
        VALUES (:nom, :ape, :dni, :dir, :tel, :est)";
         $resultado = $this->conex->prepare($var);
         
         $resultado->bindValue(":nom",$data["txtNombres"]);
         $resultado->bindValue(":ape",$data["txtApellidos"]);
         $resultado->bindValue(":dni",$data["txtDni"]);
         $resultado->bindValue(":dir",$data["txtDireccion"]);
         $resultado->bindValue(":tel",$data["txtTelefono"]);
         $resultado->bindValue(":est",$data["cboEstado"]);
         $resultado->execute();
         $ultimoID = $this->conex->lastInsertId();
         if($ultimoID > 0){
             $arrayName = array('estado' =>"ok" ,"datos"=>"Cliente Registrado");
         }
         else{
             $arrayName = array('estado' =>"no" ,"datos"=>"Cliente no se registro");
         }
         return $arrayName;
    }
    public function Moficar($data){
        
        $var = "UPDATE tbclientes SET Nombres=:nom, Apellidos=:ape, Dni=:dni, Direccion=:dir, Telefono=:tel, Estado=:est WHERE IdCliente=:id";
         $resultado = $this->conex->prepare($var);
         
         $resultado->bindValue(":nom",$data["txtNombres"]);
         $resultado->bindValue(":ape",$data["txtApellidos"]);
         $resultado->bindValue(":dni",$data["txtDni"]);
         $resultado->bindValue(":dir",$data["txtDireccion"]);
         $resultado->bindValue(":tel",$data["txtTelefono"]);
         $resultado->bindValue(":est",$data["cboEstado"]);
         $resultado->bindValue(":id",$data["txtID"]);
         $resultado->execute();
        //  $ultimoID = $this->conex->lastInsertId();
         if($resultado->execute()){
             $arrayName = array('estado' =>"ok" ,"datos"=>"Cliente Modificado");
         }
         else{
             $arrayName = array('estado' =>"no" ,"datos"=>"Cliente No se pudo Modificar");
         }
         return $arrayName;
    }
    public function Eliminar($id){
        $var = "DELETE FROM tbclientes  WHERE IdCliente=".$id;
         $resultado = $this->conex->prepare($var);
         if($resultado->execute()){
             $arrayName = array('estado' =>"ok" ,"datos"=>"Cliente Eliminado");
         }
         else{
             $arrayName = array('estado' =>"no" ,"datos"=>"Cliente No se pudo Eliminar");
         }
         return $arrayName;
    }

}

?>