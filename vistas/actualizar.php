<?php
require("../controladores/ctrMostrarTProducto.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100px;
            height: auto;
        }

        select, input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-wrap: wrap;
        }

        .form-group label {
            width: 20%;
            text-align: right;
            padding-right: 10px;
        }

        .form-group input,
        .form-group select {
            width: 80%;
        }

        .button-container {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>MODIFICAR CURSOS</h1>
    <main class="products container">
        <h2>Editar Productos</h2>
        <?php foreach ($productos as $producto) { ?>
            <form method="post" action="../controladores/ctrlmodificarproducto.php?id=<?php echo $producto['id_producto']; ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="producto">Nombre:</label>
                    <input type="text" name="producto" value="<?php echo $producto['producto']; ?>">
                </div>
                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input type="text" name="stock" value="<?php echo $producto['stock']; ?>">
                </div>
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="text" name="precio" value="<?php echo $producto['precio']; ?>">
                </div>
                <div class="form-group">
                    <label for="id_status">Estatus:</label>
                    <select name="id_status">
                        <option value="1" <?php echo ($producto['id_status'] == 1) ? 'selected' : ''; ?>>Disponible</option>
                        <option value="2" <?php echo ($producto['id_status'] == 2) ? 'selected' : ''; ?>>Descontinuado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" name="descripcion" value="<?php echo $producto['descripcion']; ?>">
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen:</label>
                    <img src="../assets/images/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['producto']; ?>">
                </div>
                <div class="form-group">
                    <label for="nueva_imagen">Nueva Imagen:</label>
                    <input type="file" name="imagen">
                </div>
                <div class="button-container">
                    <button type="submit">Guardar Cambios</button>
                </div>
            </form>
        <?php } ?>
    </main>
</body>
</html>
