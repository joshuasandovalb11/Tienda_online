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
    <link rel="stylesheet" href="tienda_style.css">
    <title>Agregar producto</title>
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
    <div class="form-container">
            <h3 class="form-title-h2">Producto</h3>
            <h4 class="form-title-h4">Introduce los datos correspondientes al producto que deseas agregar a la lista</h4>
            <form class="row g-3 needs-validation" action="" method="POST" novalidate>
                <div class="col-md-4">
                    <label for="nombre" class="form-label">Nombre del producto</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Proporciona un título claro.
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="sku" class="form-label">Código o SKU</label>
                    <input type="text" class="form-control" id="sku" name="sku" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Proporciona un identificador único para el producto.
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Proporciona un precio.
                    </div>
                </div>

                <div class="col-md-5">
                    <label for="categoria_id" class="form-label">Categoría</label>
                    <select class="form-select" id="categoria_id" name="categoria_id" required>
                        <option selected disabled value="">Escoge...</option>
                        <?php
                        $sql = "SELECT id, nombre FROM categorias";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay categorías disponibles</option>";
                        }
                        ?>
                    </select>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Selecciona una categoria.
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="cantidad" class="form-label">Cantidad en stock</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Proporciona una cantidad para el producto.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción del producto</label>
                    <textarea class="form-control" id="descripcion" placeholder="" name="descripcion" required></textarea>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Proporciona una descripcion.
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                        <label class="form-check-label" for="invalidCheck">
                        Acepto terminos y condiciones
                        </label>
                        <div class="invalid-feedback">
                        Debes aceptar antes de continuar.
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Guardar producto</button>
                </div>
            </form>
        </div>

    </main>

    <script src="funciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Esperar 5 segundos antes de ocultar el mensaje (la duración de la animación)
        setTimeout(function() {
            var alertMessage = document.querySelector('.alert');
            if (alertMessage) {
                alertMessage.style.display = 'none'; // Oculta el mensaje
            }
        }, 5000); // 5000ms = 5 segundos
    </script>

</body>
</html>

