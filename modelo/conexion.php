<?php
    class ConexionDB{
        private $host="localhost";
        private $user="root";
        private $password="";
        private $db="polleria";

        private $conexion;

        public function __construct() {
            $conec = "mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8";
            try {
                $this->conexion = new PDO($conec,$this->user,$this->password);
                // Para detectar Errrores
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                $this->conexion="Error de Conexion";
                echo "ERROR: ".$e->getMessage();
            }
        }
        public function Conectar(){
            return $this->conexion;
        }
    }

?>