<?php
class Conexion
{
    private string $host = 'localhost';
    private string $db = 'integradora';
    private string $usuario = 'root';
    private string $clave = '';
    private string $charset = 'utf8mb4';

    public function conectar(): PDO
    {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";

        try {
            return new PDO($dsn, $this->usuario, $this->clave, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die('Error de conexión con MySQL: ' . htmlspecialchars($e->getMessage()));
        }
    }
}
