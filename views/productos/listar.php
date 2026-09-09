<?php
$baseUrl = 'index.php';
$productosDestacados = array_slice($productos, 0, 4);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcotecStore | Productos</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header class="topbar">
    <div class="contenedor nav">
        <a class="identidad" href="index.php" aria-label="Universidad Ecotec">
            <img class="logo-ecotec" src="assets/logo-ecotec.png" alt="Logo Universidad Ecotec">
            <span class="identidad-linea"></span>
            <span class="universidad"><small>Universidad</small><strong>Ecotec</strong></span>
        </a>
        <a class="marca" href="index.php"><span class="eco">ecotec</span><span class="store">Store</span></a>

        <nav>
            <button type="button" class="productos-toggle" id="productosToggle" aria-expanded="false" aria-controls="productosDropdown">
                Productos <span class="chevron" aria-hidden="true">⌄</span>
            </button>

            <div class="dropdown-productos" id="productosDropdown">
                <div class="dropdown-cabecera">
                    <div>
                        <strong>Productos registrados</strong>
                        <span><?= count($productos) ?> producto(s) disponibles</span>
                    </div>
                    <span class="contador-badge"><?= count($productos) ?></span>
                </div>
                <div class="dropdown-lista">
                    <?php if (empty($productos)): ?>
                        <div class="dropdown-vacio">Todavía no hay productos registrados.</div>
                    <?php else: ?>
                        <?php foreach (array_slice($productos, 0, 8) as $producto): ?>
                            <a class="dropdown-item" href="#producto-<?= (int)$producto['id'] ?>">
                                <span class="dropdown-icon"><?= strtoupper(substr($producto['nombre'], 0, 1)) ?></span>
                                <span class="dropdown-info">
                                    <strong><?= htmlspecialchars($producto['nombre']) ?></strong>
                                    <small><?= htmlspecialchars($producto['categoria']) ?> · <?= (int)$producto['cantidad'] ?> unidades</small>
                                </span>
                                <span class="dropdown-precio">$<?= number_format((float)$producto['precio'], 2) ?></span>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <a class="boton pequeno" style="width:100%;margin-top:10px;" href="index.php?accion=crear">＋ Registrar nuevo producto</a>
            </div>

            <a class="nav-link" href="#destacados">Destacados</a>
            <a class="boton pequeno" href="index.php?accion=crear">＋ Nuevo producto</a>
        </nav>
    </div>
</header>

<main class="contenedor">
    <section class="hero">
        <div class="hero-copy">
            <span class="eyebrow">Tecnología · Innovación · Ecotec</span>
            <h1>Bienvenido a<br><span class="azul">ecotec</span>Store</h1>
            <p>Encuentra y administra productos de tecnología, accesorios y más. Calidad, innovación y confianza en un solo lugar.</p>
            <div class="hero-acciones">
                <a class="boton" href="#destacados">▣ &nbsp; Ver productos</a>
                <a class="boton outline" href="index.php?accion=crear">＋ &nbsp; Nuevo producto</a>
            </div>
        </div>

        <div class="hero-visual" aria-hidden="true">
            <div class="hero-panel">
                <div class="panel-grid"></div>
                <div class="visual-dots"></div>
                <div class="logo-orbita">
                    <img src="assets/logo-ecotec.png" alt="">
                    <span>Universidad Ecotec</span>
                </div>
                <div class="visual-copy">
                    <small>ecotecStore</small>
                    <h3>Innovación<br>Conocimiento<br>Futuro</h3>
                    <p>Gestión de productos con PHP, MySQL y arquitectura MVC.</p>
                </div>
            </div>
        </div>
    </section>

    <?php if ($mensaje !== ''): ?>
        <div class="alerta exito"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <section class="beneficios">
        <article class="beneficio"><div class="beneficio-icon">▣</div><strong>Gestión rápida</strong><span>Registra y consulta productos.</span></article>
        <article class="beneficio"><div class="beneficio-icon">◇</div><strong>Compra segura</strong><span>Datos organizados y protegidos.</span></article>
        <article class="beneficio"><div class="beneficio-icon">◉</div><strong>Soporte 24/7</strong><span>Una interfaz pensada para ayudarte.</span></article>
        <article class="beneficio"><div class="beneficio-icon">◆</div><strong>Respaldo Ecotec</strong><span>Innovación, conocimiento y futuro.</span></article>
    </section>

    <section id="destacados">
        <div class="seccion-titulo">
            <div>
                <h2>Productos <span class="azul">destacados</span></h2>
                <p>Los últimos productos registrados en tu base de datos.</p>
            </div>
            <a class="link-todos" href="#inventario">Ver todos →</a>
        </div>
        <div class="productos-grid">
            <?php if (empty($productosDestacados)): ?>
                <div class="tarjeta" style="padding:30px;color:var(--muted);">No hay productos registrados todavía.</div>
            <?php else: ?>
                <?php foreach ($productosDestacados as $producto): ?>
                    <a class="producto-card" href="#producto-<?= (int)$producto['id'] ?>">
                        <span class="producto-icon"><?= strtoupper(substr($producto['nombre'], 0, 1)) ?></span>
                        <span class="producto-info">
                            <strong><?= htmlspecialchars($producto['nombre']) ?></strong>
                            <small><?= htmlspecialchars($producto['categoria']) ?></small>
                            <b>$<?= number_format((float)$producto['precio'], 2) ?></b>
                        </span>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <section class="tarjeta" id="inventario" style="margin-top:34px;">
        <div class="barra-tabla">
            <div>
                <h2>Inventario actual</h2>
                <p>Consulta, busca y administra lo que estás registrando.</p>
            </div>
            <form class="buscador" action="index.php#inventario" method="GET">
                <input type="text" name="q" value="<?= htmlspecialchars($busqueda) ?>" placeholder="Buscar producto...">
                <button type="submit">Buscar</button>
                <?php if ($busqueda !== ''): ?>
                    <a class="limpiar" href="index.php#inventario">Limpiar</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="tabla-responsive">
            <table>
                <thead><tr><th>ID</th><th>Producto</th><th>Categoría</th><th>Precio</th><th>Stock</th><th>Descripción</th><th>Acciones</th></tr></thead>
                <tbody>
                <?php if (empty($productos)): ?>
                    <tr><td colspan="7" class="vacio">No existen productos para mostrar.</td></tr>
                <?php else: ?>
                    <?php foreach ($productos as $producto): ?>
                        <tr id="producto-<?= (int)$producto['id'] ?>">
                            <td>#<?= (int)$producto['id'] ?></td>
                            <td><strong><?= htmlspecialchars($producto['nombre']) ?></strong></td>
                            <td><span class="badge"><?= htmlspecialchars($producto['categoria']) ?></span></td>
                            <td class="precio">$<?= number_format((float)$producto['precio'], 2) ?></td>
                            <td class="stock"><?= (int)$producto['cantidad'] ?></td>
                            <td><?= htmlspecialchars($producto['descripcion'] ?: '—') ?></td>
                            <td><a class="enlace-peligro" href="index.php?accion=eliminar&id=<?= (int)$producto['id'] ?>" data-confirmar="¿Seguro que deseas eliminar este producto?">Eliminar</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<footer>
    <div class="contenedor footer-flex">
        <div class="footer-brand"><span>ecotec</span>Store · Universidad Ecotec</div>
        <div>Mike G. Quishpe A.</div>
    </div>
</footer>
<script src="js/script.js"></script>
</body>
</html>
