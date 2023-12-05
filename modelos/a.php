<?php

class a
{

    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }
    public function Actualizar($producto,$descripcion, $imagen, $precio, $stock, $id_status, $id_producto)
    {
        echo"actualizar";
        // Obtén la ubicación temporal del archivo y el nombre del archivo
        $imagen_temp = $_FILES["imagen"]["tmp_name"];
        $imagen_nombre = $_FILES["imagen"]["name"];
        echo "El nombre del archivo temporal es: " . $imagen_temp . ", y el nombre del archivo es: " . $imagen_nombre;
        
        // Mueve el archivo subido a la ubicación de destino
        if (move_uploaded_file($imagen_temp, "../assets/images/" . $imagen_nombre)) {
            // Preparar la consulta SQL e insertar los datos en la tabla
            $conn = $this->db;
            //update producto set producto='',descripción='',precio=1,stock=1,imagen='',id_status=1;
            $sql = "UPDATE producto SET producto = :nombre_producto,descripcion=:descripcion, precio = :precio,imagen=:imagen, stock = :stock, id_status = :id_status WHERE id_producto = :id_producto";
    // ...
$stmt = $conn->prepare($sql);
$stmt->bindParam(':nombre_producto', $producto, PDO::PARAM_STR); // Cambiar :producto a :nombre_producto
$stmt->bindParam(':imagen', $imagen_nombre, PDO::PARAM_STR); // Cambiar :imagen a :imagen_nombre
$stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
$stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
$stmt->bindParam(':id_status', $id_status, PDO::PARAM_INT);
$stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
$stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo "Cambios guardados correctamente";
} else {
    $errorInfo = $stmt->errorInfo();
    echo "Error al actualizar el producto: " . $errorInfo[2];
}
// ...

        } else {
            echo "Error al mover el archivo subido.";
        }
    }
    
    

}