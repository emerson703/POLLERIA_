<?php
session_start();

include "conexion.php";
class productoDao extends ConexionDB{
    private $conex;
    public function __construct() {
        $this->conex = new ConexionDB();
        $this->conex = $this->conex->Conectar();
    }
    public function mostraID($id){
        $var = "SELECT * FROM tbproductos where IdProducto=".$id;
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
        $var2 = "SELECT * FROM tbproductos";
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
        
        $var = "INSERT INTO tbproductos (Descripcion, Precio, Stock, Detalle, Estado)
        VALUES (:descri, :pre, :stoc, :detal, :est)";
         $resultado = $this->conex->prepare($var);
         
         $resultado->bindValue(":descri",$data["txtDescripcion"]);
         $resultado->bindValue(":pre",$data["txtPrecio"]);
         $resultado->bindValue(":stoc",$data["txtStock"]);
         $resultado->bindValue(":detal",$data["txtDetalle"]);
         $resultado->bindValue(":est",$data["cboEstado"]);
         $resultado->execute();
         $ultimoID = $this->conex->lastInsertId();
         if($ultimoID > 0){
             $arrayName = array('estado' =>"ok" ,"datos"=>"Producto Registrado");
         }
         else{
             $arrayName = array('estado' =>"no" ,"datos"=>"Producto no se registro");
         }
         return $arrayName;
    }
    public function Moficar($data){
        
        $var = "UPDATE tbproductos SET Descripcion=:descripcion, Precio=:precio, Stock=:stock, Detalle=:detalle, Estado=:est WHERE IdProducto=:id";
         $resultado = $this->conex->prepare($var);
         
         $resultado->bindValue(":descripcion",$data["txtDescripcion"]);
         $resultado->bindValue(":precio",$data["txtPrecio"]);
         $resultado->bindValue(":stock",$data["txtStock"]);
         $resultado->bindValue(":detalle",$data["txtDetalle"]);
         $resultado->bindValue(":est",$data["cboEstado"]);
         $resultado->bindValue(":id",$data["txtID"]);
         $resultado->execute();
        //  $ultimoID = $this->conex->lastInsertId();
         if($resultado->execute()){
             $arrayName = array('estado' =>"ok" ,"datos"=>"Producto Modificado");
         }
         else{
             $arrayName = array('estado' =>"no" ,"datos"=>"Producto No se pudo Modificar");
         }
         return $arrayName;
    }
    public function Eliminar($id){
        $var = "DELETE FROM tbproductos  WHERE IdProducto=".$id;
         $resultado = $this->conex->prepare($var);
         if($resultado->execute()){
             $arrayName = array('estado' =>"ok" ,"datos"=>"Producto Eliminado");
         }
         else{
             $arrayName = array('estado' =>"no" ,"datos"=>"Producto No se pudo Eliminar");
         }
         return $arrayName;
    }

}

?>