# Actividad Integradora 3 — Aplicación Web con PHP, MySQL y MVC

## Proyecto
**ecotecStore — Gestión de productos**

Aplicación web académica construida con HTML, CSS, JavaScript, PHP y MySQL utilizando el patrón MVC.

## Funcionalidades
- Registro de productos.
- Validaciones en JavaScript antes de enviar el formulario.
- Validaciones adicionales en PHP.
- Inserción en MySQL mediante el Modelo.
- Consulta y visualización en tabla HTML.
- Búsqueda por nombre, categoría o descripción.
- Eliminación de productos con confirmación.
- Diseño responsive con CSS, Flexbox y Grid.
- Consultas preparadas con PDO.

## Estructura MVC
```text
actividad-integradora-3/
├── index.php
├── config/
│   └── conexion.php
├── controllers/
│   └── ProductoController.php
├── models/
│   └── Producto.php
├── views/
│   └── productos/
│       ├── crear.php
│       └── listar.php
├── css/
│   └── estilos.css
├── js/
│   └── script.js
├── database/
│   └── integradora.sql
└── README.md
```

## Requisitos
- XAMPP con Apache y MySQL activos.

## Instalación en XAMPP
1. Copiar la carpeta `actividad-integradora-3` dentro de `C:\xampp\htdocs\`.
2. Iniciar **Apache** y **MySQL** desde el panel de XAMPP.
3. Abrir `http://localhost/phpmyadmin`.
4. Importar `database/integradora.sql`.
5. Abrir `http://localhost/actividad-integradora-3/`.

La conexión incluida usa:
- Host: `localhost`
- Base de datos: `integradora`
- Usuario: `root`
- Contraseña: vacía

## Flujo MVC
Vista → Controlador → Modelo → Base de datos

- **Vista:** formulario y tabla HTML.
- **Controlador:** recibe acciones, valida en servidor y coordina el flujo.
- **Modelo:** ejecuta `SELECT`, `INSERT` y `DELETE` en MySQL.
- **Base de datos:** almacena los productos.


