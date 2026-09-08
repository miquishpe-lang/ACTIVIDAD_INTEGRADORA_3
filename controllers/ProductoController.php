<?php
require_once __DIR__ . '/../models/Producto.php';

class ProductoController
{
    private Producto $modelo;

    public function __construct()
    {
        $this->modelo = new Producto();
    }

    public function listar(): void
    {
        $busqueda = trim($_GET['q'] ?? '');
        $productos = $this->modelo->obtenerTodos($busqueda);
        $mensaje = $_GET['mensaje'] ?? '';
        require __DIR__ . '/../views/productos/listar.php';
    }

    public function crear(): void
    {
        $errores = [];
        $datos = [
            'nombre' => '',
            'categoria' => '',
            'precio' => '',
            'cantidad' => '',
            'descripcion' => '',
        ];
        require __DIR__ . '/../views/productos/crear.php';
    }

    public function guardar(): void
    {
        $datos = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'categoria' => trim($_POST['categoria'] ?? ''),
            'precio' => trim($_POST['precio'] ?? ''),
            'cantidad' => trim($_POST['cantidad'] ?? ''),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
        ];

        $errores = $this->validar($datos);

        if (!empty($errores)) {
            require __DIR__ . '/../views/productos/crear.php';
            return;
        }

        $guardado = $this->modelo->insertar($datos);
        $mensaje = $guardado ? 'Producto registrado correctamente.' : 'No se pudo registrar el producto.';
        header('Location: index.php?mensaje=' . urlencode($mensaje));
        exit;
    }

    public function eliminar(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id || $id < 1) {
            header('Location: index.php?mensaje=' . urlencode('ID de producto no válido.'));
            exit;
        }

        $eliminado = $this->modelo->eliminar($id);
        $mensaje = $eliminado ? 'Producto eliminado correctamente.' : 'No se pudo eliminar el producto.';
        header('Location: index.php?mensaje=' . urlencode($mensaje));
        exit;
    }

    private function validar(array $datos): array
    {
        $errores = [];

        if ($datos['nombre'] === '' || mb_strlen($datos['nombre']) < 3 || mb_strlen($datos['nombre']) > 100) {
            $errores[] = 'El nombre debe contener entre 3 y 100 caracteres.';
        }

        $categoriasValidas = ['Tecnología', 'Hogar', 'Ropa', 'Accesorios', 'Otros'];
        if (!in_array($datos['categoria'], $categoriasValidas, true)) {
            $errores[] = 'Seleccione una categoría válida.';
        }

        if (!is_numeric($datos['precio']) || (float)$datos['precio'] <= 0) {
            $errores[] = 'El precio debe ser un número mayor que 0.';
        }

        if (filter_var($datos['cantidad'], FILTER_VALIDATE_INT) === false || (int)$datos['cantidad'] < 0) {
            $errores[] = 'La cantidad debe ser un número entero igual o mayor que 0.';
        }

        if (mb_strlen($datos['descripcion']) > 255) {
            $errores[] = 'La descripción no puede superar los 255 caracteres.';
        }

        return $errores;
    }
}
