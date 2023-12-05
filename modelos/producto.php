<?php
 require('conexion.php');

class producto{
    private $db;
    public function __construct() {
        $con = new Conexion();
        $this->db = $con->conectar();
    } 
    public function mostrarProductos() {

        //select id_producto, producto, descripción, stock, imagen, precio, id_status from producto where id_status=1;
      $query = "SELECT id_producto, producto, descripcion, stock, imagen, precio, id_status from producto where id_status=1;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $cursos = array(); // Inicializa un array para almacenar los cursos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cursos[] = $row;
        }
        return $cursos; // Devuelve el array de cursos
    }
    public function mostrarTodosProductos() {
        //select id_producto, producto, descripción, stock, imagen, precio, id_status from producto
      $query = "SELECT id_producto, producto, descripcion, stock, imagen, precio from producto";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $cursos = array(); // Inicializa un array para almacenar los cursos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cursos[] = $row;
        }
        return $cursos; // Devuelve el array de cursos
    }
    
    

    
    public function Actualizar($nombre_producto, $foto, $precio, $stock, $status, $id_producto)
    {
        // Preparar la consulta SQL e insertar los datos en la tabla
        $conn = $this->db;
    
        $sql = "UPDATE producto SET nombre_producto = :nombre_producto, foto = :foto, precio = :precio, stock = :stock, status = :status WHERE id_producto = :id_producto";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre_producto', $nombre_producto, PDO::PARAM_STR);
        $stmt->bindParam(':foto', $foto, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
        $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            $imagen_nombre = $_FILES["foto"]["name"];
            $imagen_temp = $_FILES["foto"]["tmp_name"];
            move_uploaded_file($imagen_temp, "../assets/img/" . $imagen_nombre);
            
            echo "Cambios guardados correctamente";
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Error al actualizar el producto: " . $errorInfo[2];
        }
    }
    
}
?>