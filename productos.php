<?php
// Incluir el archivo de conexión a la base de datos
include 'BE/conexion.php';

// Procesar eliminación de producto
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_stmt = $conn->prepare("DELETE FROM productos WHERE id = ?");
    $delete_stmt->bind_param("i", $delete_id);
    if ($delete_stmt->execute()) {
        $success = "Producto eliminado con éxito.";
    } else {
        $error = "Error al eliminar el producto: " . $delete_stmt->error;
    }
    $delete_stmt->close();
}

// Procesar el formulario al enviarlo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $sku = $_POST['sku'];
    $categoria_id = $_POST['categoria_id'];

    // Validar los datos (ejemplo básico)
    if (empty($nombre) || empty($descripcion) || empty($precio) || empty($cantidad) || empty($sku) || empty($categoria_id)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Preparar e insertar el producto
        $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, cantidad, sku, categoria_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdisi", $nombre, $descripcion, $precio, $cantidad, $sku, $categoria_id);

        if ($stmt->execute()) {
            $success = "Producto agregado con éxito.";
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=SUSE:wght@100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="productos_style.css">
    <title>Productos</title>
</head>
<body>
    <header class="header">
        <div class="logo">
            <span>A</span>
        </div>
        <div class="actions">
            <a class="btn btn-exit" href="index.php"> Regresar </a>
        </div>
    </header>

    <main>
        <!-- Tabla con los productos -->
        <div class="lista-container container mt-4">
            <p class="lista-title">Lista de productos</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>SKU</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Obtener los productos de la base de datos
                    $sql = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.cantidad, p.sku, c.nombre AS categoria
                            FROM productos p
                            INNER JOIN categorias c ON p.categoria_id = c.id";
                    $result = $conn->query($sql);
    
                    // Verificar si hay productos y mostrar los datos
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
                            echo "<td>" . number_format($row['precio'], 2) . "</td>";
                            echo "<td>" . $row['cantidad'] . "</td>";
                            echo "<td>" . $row['sku'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['categoria']) . "</td>";
                            echo "<td>";
                            echo "<a href='?delete_id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este producto?\")'>Eliminar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No hay productos disponibles</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>   
    </main>

</body>
</html>