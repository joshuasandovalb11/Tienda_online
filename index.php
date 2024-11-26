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
    <link rel="stylesheet" href="index.css">
    <title>Tienda Online</title>
</head>
<body>
    <header class="header">
        <div class="logo">
            <span>A</span>
        </div>
        <nav class="nav">
            <a href="index.php">Inicio</a>
        </nav>
    </header>

    <!-- Sección central -->
    <main class="iconos-container container text-center my-5">
        <div class="row justify-content-center">
            <!-- Enlace a lista de productos -->
            <div class="col-md-4">
                <a href="productos.php" class="text-decoration-none text-dark">
                    <i class="fas fa-list fa-5x icono"></i>
                    <h3 class="mt-3">Lista de Productos</h3>
                </a>
            </div>
            <!-- Enlace a agregar productos -->
            <div class="col-md-4">
                <a href="tienda.php" class="text-decoration-none text-dark">
                    <i class="fas fa-plus-circle fa-5x icono"></i>
                    <h3 class="mt-3">Agregar Productos</h3>
                </a>
            </div>
        </div>
    </main>
    
</body>
</html>
