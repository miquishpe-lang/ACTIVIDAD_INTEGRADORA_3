CREATE DATABASE IF NOT EXISTS integradora
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE integradora;

CREATE TABLE IF NOT EXISTS productos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    cantidad INT UNSIGNED NOT NULL DEFAULT 0,
    descripcion VARCHAR(255) NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO productos (nombre, categoria, precio, cantidad, descripcion) VALUES
('Mouse inalámbrico', 'Tecnología', 20.00, 5, 'Mouse ergonómico con conexión USB.'),
('Teclado mecánico', 'Tecnología', 35.00, 3, 'Teclado compacto para escritorio.'),
('Lámpara de escritorio', 'Hogar', 18.50, 8, 'Lámpara LED con brazo ajustable.');
