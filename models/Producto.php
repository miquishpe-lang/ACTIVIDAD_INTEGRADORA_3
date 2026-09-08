<?php
require_once __DIR__ . '/../config/conexion.php';

class Producto
{
    private PDO $db;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->db = $conexion->conectar();
    }

    public function obtenerTodos(string $busqueda = ''): array
    {
        if ($busqueda !== '') {
            $sql = 'SELECT * FROM productos
                    WHERE nombre LIKE :busqueda_nombre
                       OR categoria LIKE :busqueda_categoria
                       OR descripcion LIKE :busqueda_descripcion
                    ORDER BY id DESC';
            $stmt = $this->db->prepare($sql);
            $termino = '%' . $busqueda . '%';
            $stmt->execute([
                'busqueda_nombre' => $termino,
                'busqueda_categoria' => $termino,
                'busqueda_descripcion' => $termino,
            ]);
            return $stmt->fetchAll();
        }

        $stmt = $this->db->query('SELECT * FROM productos ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function insertar(array $datos): bool
    {
        $sql = 'INSERT INTO productos (nombre, categoria, precio, cantidad, descripcion)
                VALUES (:nombre, :categoria, :precio, :cantidad, :descripcion)';
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'nombre' => $datos['nombre'],
            'categoria' => $datos['categoria'],
            'precio' => $datos['precio'],
            'cantidad' => $datos['cantidad'],
            'descripcion' => $datos['descripcion'],
        ]);
    }

    public function eliminar(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM productos WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
