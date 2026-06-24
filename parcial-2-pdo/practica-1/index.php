<?php
require_once __DIR__ . '/autoload.php';

use App\Controllers\ProductoController;
use App\Models\Producto;

$controller = new ProductoController();
$mensaje = '';
$productoEditar = null;

if (isset($_GET['eliminar'])) {
    $idEliminar = (int) $_GET['eliminar'];
    $mensaje = $controller->eliminar($idEliminar)
        ? 'Producto eliminado correctamente.'
        : 'Error al eliminar el producto.';
}

if (isset($_GET['editar'])) {
    $idEditar = (int) $_GET['editar'];
    $productoEditar = $controller->obtenerPorId($idEditar);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = !empty($_POST['id']) ? (int) $_POST['id'] : null;
    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $existencia = (int) ($_POST['existencia'] ?? 0);
    $precio = (float) ($_POST['precio'] ?? 0);

    $producto = new Producto();
    $producto->setId($id);
    $producto->setNombre($nombre);
    $producto->setDescripcion($descripcion);
    $producto->setExistencia($existencia);
    $producto->setPrecio($precio);

    if ($id) {
        $mensaje = $controller->actualizar($producto)
            ? 'Producto actualizado correctamente.'
            : 'Error al actualizar el producto.';
    } else {
        $mensaje = $controller->crear($producto)
            ? 'Producto agregado correctamente.'
            : 'Error al agregar el producto.';
    }
}

$productos = $controller->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Productos con PHP PDO y POO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">CRUD de Productos con PHP, PDO y POO</h1>

    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <?= $productoEditar ? 'Editar producto' : 'Agregar producto'; ?>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?= htmlspecialchars($productoEditar['id'] ?? '') ?>">

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control"
                               value="<?= htmlspecialchars($productoEditar['nombre'] ?? '') ?>" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Descripción</label>
                        <input type="text" name="descripcion" class="form-control"
                               value="<?= htmlspecialchars($productoEditar['descripcion'] ?? '') ?>" required>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="form-label">Existencia</label>
                        <input type="number" name="existencia" class="form-control"
                               value="<?= htmlspecialchars($productoEditar['existencia'] ?? '') ?>" required>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" step="0.01" name="precio" class="form-control"
                               value="<?= htmlspecialchars($productoEditar['precio'] ?? '') ?>" required>
                    </div>

                    <div class="col-md-2 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100">
                            <?= $productoEditar ? 'Actualizar' : 'Guardar'; ?>
                        </button>
                    </div>
                </div>

                <?php if ($productoEditar): ?>
                    <a href="index.php" class="btn btn-secondary">Cancelar edición</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-dark text-white">Lista de productos</div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Existencia</th>
                    <th>Precio</th>
                    <th width="180">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php if (count($productos) > 0): ?>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?= htmlspecialchars($producto['id']) ?></td>
                            <td><?= htmlspecialchars($producto['nombre']) ?></td>
                            <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                            <td><?= htmlspecialchars($producto['existencia']) ?></td>
                            <td>$<?= number_format((float)$producto['precio'], 2) ?></td>
                            <td>
                                <a href="index.php?editar=<?= $producto['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="index.php?eliminar=<?= $producto['id'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('¿Seguro que deseas eliminar este producto?');">
                                    Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No hay productos registrados.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
