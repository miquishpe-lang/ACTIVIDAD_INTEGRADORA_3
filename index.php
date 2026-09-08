<?php
require_once __DIR__ . '/controllers/ProductoController.php';

$controller = new ProductoController();
$accion = $_GET['accion'] ?? 'listar';

switch ($accion) {
    case 'crear':
        $controller->crear();
        break;
    case 'guardar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->guardar();
        } else {
            header('Location: index.php?accion=crear');
        }
        break;
    case 'eliminar':
        $controller->eliminar();
        break;
    case 'listar':
    default:
        $controller->listar();
        break;
}
