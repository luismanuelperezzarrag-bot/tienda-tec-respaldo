<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/datos/RepositorioProductos.php';
require_once __DIR__ . '/../src/utilidades/vistas.php';

$repositorio = new RepositorioProductos(__DIR__ . '/../datos/datos.json');

$idSolicitado = (int) filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT);
$productoEncontrado = true;

try {
    $producto = $repositorio->buscarPorId($idSolicitado);
} catch (OutOfBoundsException $error) {
    $productoEncontrado = false;
    http_response_code(404);
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Tec - <?= $productoEncontrado ? escapar($producto->obtenerNombre()) : 'Producto no encontrado' ?></title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <header>
        <h1>Bienvenido a Tienda Tec</h1>
        <nav aria-label="principal">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="productos.php" aria-current="page">Catálogo</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <nav class="migas" aria-label="ruta de navegacion">
            <ol>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="productos.php">Catálogo</a></li>
                <li aria-current="page"><?= $productoEncontrado ? escapar($producto->obtenerNombre()) : 'No encontrado' ?></li>
            </ol>
        </nav>

        <?php if ($productoEncontrado): ?>
            <article>
                <img src="<?= escapar($producto->obtenerImagen()) ?>" alt="Foto de <?= escapar($producto->obtenerNombre()) ?>">
                <div class="tarjeta-producto-info">
                    <h2><?= escapar($producto->obtenerNombre()) ?></h2>
                    <p class="etiqueta-categoria">Categoría: <?= escapar($producto->obtenerCategoria()->obtenerNombre()) ?></p>
                    <p class="texto-secundario"><?= escapar($producto->obtenerDescripcion()) ?></p>
                    <p class="tarjeta-producto-precio">Precio: <?= $producto->obtenerPrecioFormateado() ?></p>
                    <?php mostrarDisponibilidad($producto); ?>
                </div>
            </article>
        <?php else: ?>
            <section>
                <h2>Producto no encontrado</h2>
                <p>El producto que buscas no existe o ya no está disponible.</p>
                <a class="boton-agregar" href="productos.php">Volver al catálogo</a>
            </section>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2026 Tienda Tec. Todos los derechos reservados</p>
    </footer>
</body>
</html>