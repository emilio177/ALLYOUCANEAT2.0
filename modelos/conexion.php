

<?php
class Conexion {
    private $DBServer = '127.0.0.1'; // Cambia esto al nombre o dirección IP de tu servidor de base de datos
    private $DBUser = 'gerente'; // Cambia esto a tu nombre de usuario de la base de datos
    private $DBPass = '123'; // Cambia esto a tu contraseña de la base de datos
    private $DBName = 'restaurante'; // Cambia esto a tu nombre de base de datos

    public function __construct() {}

    public function conectar() {
        try {
            $conn = new PDO("mysql:host={$this->DBServer};dbname={$this->DBName}", $this->DBUser, $this->DBPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}


