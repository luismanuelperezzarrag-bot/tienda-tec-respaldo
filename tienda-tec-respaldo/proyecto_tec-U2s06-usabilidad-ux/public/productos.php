<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/datos/RepositorioProductos.php';
require_once __DIR__ . '/../src/utilidades/vistas.php';

$repositorio = new RepositorioProductos(__DIR__ . '/../datos/datos.json');
$categorias = $repositorio->obtenerCategorias();

$categoriaSeleccionada = trim((string) ($_GET['categoria'] ?? ''));
$errorCategoria = '';
$productos = [];

try {
    if ($categoriaSeleccionada === '') {
        $productos = $repositorio->obtenerTodos();
    } else {
        $productos = $repositorio->obtenerPorCategoria($categoriaSeleccionada);
    }
} catch (OutOfBoundsException $error) {
    $errorCategoria = $error->getMessage();
    http_response_code(404);
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Tec - Productos</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <header>
        <h1>Productos</h1>
        <nav aria-label="principal">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="productos.php" aria-current="page">Catálogo</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Catálogo</h2>
        <a href="agregar-producto.php" class="boton-agregar">Agregar producto +</a>

        <nav aria-label="Filtrar por categoría" style="margin-bottom: 16px;">
            <a class="etiqueta-categoria" href="productos.php">Todas</a>
            <?php foreach ($categorias as $categoria): ?>
                <?php $nombreCat = $categoria->obtenerNombre(); ?>
                <a class="etiqueta-categoria" href="productos.php?categoria=<?= urlencode($nombreCat) ?>">
                    <?= escapar($nombreCat) ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <?php if ($errorCategoria !== ''): ?>
            <p><?= escapar($errorCategoria) ?></p>
            <a class="boton-agregar" href="productos.php">Ver todos los productos</a>
        <?php elseif (empty($productos)): ?>
            <p>No hay productos registrados en esta categoría.</p>
        <?php else: ?>
            <section class="tarjetas-productos">
                <?php foreach ($productos as $producto): ?>
                    <?php mostrarTarjetaProducto($producto, 3); ?>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2026 Tienda Tec. Todos los derechos reservados</p>
    </footer>
</body>
</html>