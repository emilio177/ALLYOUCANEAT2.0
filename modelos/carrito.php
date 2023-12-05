<?php

class carrito
{
    private $db;
    public function __construct()
    {
        $con = new Conexion();
        $this->db = $con->conectar();
    }
    public function carritosContador($id_usuario)
    {   
        //        SELECT count(id_producto) AS total FROM carrito WHERE id_usuario = 1;
        $query = "SELECT sum(cantidad) AS total FROM carrito WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);
            $total = $fila["total"];
            return $total; // Devuelve el valor en lugar de imprimirlo
        } else {
            return 0; // Devuelve 0 en caso de error
        }
    }
    private function actualizarStock($producto_id, $cantidad)
    {   //update producto set stock=2 where id_producto;
        $query = "UPDATE producto SET stock = stock - :cantidad WHERE id_producto = :id_producto";
        $rs = $this->db->prepare($query);
        $rs->bindParam(':id_producto', $producto_id, PDO::PARAM_INT);
        $rs->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);

        if ($rs->execute()) {
            // El stock se ha actualizado correctamente
            echo "Stock actualizado exitosamente.";
        } else {
            // Hubo un error al actualizar el stock
            echo "Error al actualizar el stock.";
        }
    }
    public function agregarCarrito($id_usuario, $producto_id, $cantidad)
    {
        // Primero, verifica si la cantidad a comprar es menor o igual al stock disponible
        if ($this->verificarStockSuficiente($producto_id, $cantidad)) {
            // insert into  carrito (id_producto, id_usuario) values ();
            $query = "INSERT INTO carrito (id_producto, id_usuario,cantidad)  VALUES ( :id_producto,:id_usuario,:cantidad)";
            $rs = $this->db->prepare($query);
            $rs->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $rs->bindParam(':id_producto', $producto_id, PDO::PARAM_INT);
            $rs->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);


            if ($rs->execute()) {
                // La compra se ha registrado correctamente en la base de datos
                echo "¡Se agregó a su carrito :D siga comprando!";
                $this->actualizarStock($producto_id, $cantidad); // Llamamos a la función para actualizar el stock
            } else {
                // Hubo un error al registrar la compra
                echo "Error al registrar la compra.";
            }
        } else {
            // La cantidad a comprar es mayor que el stock disponible
            echo "La cantidad a comprar es mayor que el stock disponible.";
        }
    }

    // Función para verificar si el stock es suficiente
    private function verificarStockSuficiente($producto_id, $cantidad)
    {
        $query = "SELECT stock FROM producto WHERE id_producto = :id_producto";
        $rs = $this->db->prepare($query);
        $rs->bindParam(':id_producto', $producto_id, PDO::PARAM_INT);
        $rs->execute();

        $row = $rs->fetch(PDO::FETCH_ASSOC);

        if ($row['stock'] >= $cantidad) {
            // El stock es suficiente
            return true;
        } else {
            // El stock no es suficiente
            return false;
        }
    }
    public function obtenerCarrito($user_id)
    {
        /* select p.nombre_producto,cantidad,p.precio,p.foto,
        sum(c.cantidad*p.precio) as subtotal from carrito c
         join producto p on p.id_producto = c.id_producto
         join usuario u on u.id_usuario = c.id_usuario
         where c.id_usuario=11
group by 1 desc
order by 1;*/
$query = "SELECT p.id_producto, p.producto, SUM(c.cantidad) as cantidad, p.precio, p.imagen, SUM(c.cantidad * p.precio) as subtotal, u.id_usuario
FROM carrito c
JOIN producto p ON p.id_producto = c.id_producto
JOIN usuario u ON u.id_usuario = c.id_usuario
WHERE c.id_usuario = :id_usuario
GROUP BY p.id_producto, p.producto, p.precio, p.imagen, u.id_usuario
ORDER BY p.id_producto
";


        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_usuario', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $p = array(); // Inicializa un array para almacenar los cursos

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $p[] = $row;
        }
        return $p; // Devuelve el array de cursos
    }

    public function comprarCarrito($id_usuario)
    {
        // Verificar si hay cursos en el carrito
        $carritoCursos = $this->obtenerCarrito($id_usuario); // Asegúrate de pasar el ID del usuario
        if (empty($carritoCursos)) {
            echo "No hay producto en carrito. Agregue antes de comprar.";
            return;
        }

        
        foreach ($carritoCursos as $curso) {
            $id_usuario = $curso["id_usuario"];
            $id_producto = $curso['id_producto'];
            $cantidad = $curso['cantidad'];
            $subtotal = $curso['subtotal'];
            echo 'cantidad' . $cantidad . ' subtotal' . $subtotal;
        
//INSERT INTO detalle_venta (id_producto, id_usuario, fecha) values ();             
            $query = "INSERT INTO detalle_venta (id_producto, id_usuario, fecha) VALUES (:id_producto, :id_usuario,  NOW())";
                      $rs = $this->db->prepare($query);
            $rs->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $rs->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);

            if ($rs->execute()) {
                // La compra se ha registrado correctamente en la base de datos
                echo "¡Compra registrada en la base de datos!";
     
                $this->eliminarCarrito($id_usuario);
            } else {
                // Hubo un error al registrar la compra
                echo "Error al registrar la compra.";
            }
        }}
    
        public function SubirProducto() {
            $producto = $_POST["producto"];
            $descripcion = $_POST["a"]; // Supongo que 'a' es el nombre del campo de descripción
            $stock = $_POST["stock"];
            $precio = $_POST["precio"];
            $status = 1; // Supongo que 'status' es un valor fijo
        
            // Subir la imagen
            $imagen = $_FILES["imagen"]["name"];
            $imagen_temp = $_FILES["imagen"]["tmp_name"];
            move_uploaded_file($imagen_temp, "../assets/images/" . $imagen);
        
            // Utilizar una sentencia preparada para evitar inyección SQL
            $query = "INSERT INTO producto (producto, descripcion, stock, imagen, precio, id_status) VALUES (:producto, :descripcion, :stock, :imagen, :precio, $status)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':producto', $producto, PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
            $stmt->bindParam(':imagen', $imagen, PDO::PARAM_STR);
            $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
            
        
            if ($stmt->execute()) {
                echo "Producto subido con éxito.";
            } else {
                echo "Error al subir el producto.";
            }
        }
        
    



    public function eliminarCarrito($id_usuario)
    {
        // Luego, eliminar los cursos del carrito
        $query = "DELETE FROM carrito WHERE id_usuario = :user_id";
        $rs = $this->db->prepare($query);
        $rs->bindParam(':user_id', $id_usuario, PDO::PARAM_INT);
        if ($rs->execute()) {
            // Los cursos del carrito se han eliminado correctamente
            echo "¡ del carrito eliminados!";
        } else {
            // Hubo un error al eliminar los cursos del carrito
            echo "Error al eliminar los tenis del carrito.";
        }

}

public function eliminarElementoDelCarrito($id_usuario, $producto_id)
{
    // Elimina un elemento del carrito
    $query = "DELETE FROM carrito WHERE id_usuario = :id_usuario AND id_producto = :id_producto";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':id_producto', $producto_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // El elemento se ha eliminado correctamente del carrito
        echo "¡Elemento eliminado del carrito exitosamente! id Usuario= ".$id_usuario."producto=".$producto_id;
    //    header("Location: ../html/carrito.php");
    } else {
        // Hubo un error al eliminar el elemento del carrito
        echo "Error al eliminar el elemento del carrito.";
    }
}


public function ActualizarCursos($nombre_producto, $foto, $precio, $stock, $status, $id_producto)
{
    $imagen_nombre = $_FILES["foto"]["name"];
    $imagen_temp = $_FILES["foto"]["tmp_name"];
    move_uploaded_file($imagen_temp, "../assets/img/" . $imagen_nombre);

    // Preparar la consulta SQL e insertar los datos en la tabla
    $conn = $this->db;
//update producto set nombre_producto='',foto='',precio=0,stock=1,status=1 where id_producto=1;
    $sql = "UPDATE producto SET nombre_producto = :nombre_producto, foto = :foto, precio = :precio,stock = :stock, status=:status WHERE id_producto = :id_producto";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre_producto', $nombre_producto, PDO::PARAM_STR);
    $stmt->bindParam(':foto', $foto, PDO::PARAM_STR);
    $stmt->bindParam(':precio', $precio, PDO::PARAM_STR); // Cambiado a PDO::PARAM_STR
    $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
    $stmt->bindParam(':status', $status, PDO::PARAM_INT);
    $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);

    if ($stmt->execute()) {
       // echo "Actualización exitosa.";
       // header("Location: ../html/modificarCurso.php?Update=1");
        //header("Location: ../html/carrito.php?Quitar=1");
        echo "campus actualizados";
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Error al actualizar el curso: " . $errorInfo[2];
    }
}
}