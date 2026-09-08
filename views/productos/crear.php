<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ecotecStore | Nuevo producto</title>
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
        <nav><a class="nav-link" href="index.php">Productos</a><a class="boton pequeno" href="index.php?accion=crear">＋ Nuevo producto</a></nav>
    </div>
</header>

<main class="contenedor pagina-formulario">
    <section class="tarjeta formulario-card">
        <div class="encabezado-seccion">
            <span class="eyebrow">ecotecStore · Nuevo registro</span>
            <h1>Agrega un <span style="color:var(--accent)">producto.</span></h1>
            <p>Completa los datos y guárdalos directamente en MySQL mediante el patrón MVC.</p>
        </div>

        <?php if (!empty($errores)): ?>
            <div class="alerta error" role="alert"><strong>Revisa la información:</strong><ul><?php foreach ($errores as $error): ?><li><?= htmlspecialchars($error) ?></li><?php endforeach; ?></ul></div>
        <?php endif; ?>

        <form id="formProducto" action="index.php?accion=guardar" method="POST" novalidate>
            <div class="grid-form">
                <div class="campo campo-completo"><label for="nombre">Nombre del producto *</label><input type="text" id="nombre" name="nombre" minlength="3" maxlength="100" required value="<?= htmlspecialchars($datos['nombre'] ?? '') ?>" placeholder="Ej. Laptop Lenovo"><small class="mensaje-error" id="errorNombre"></small></div>
                <div class="campo"><label for="categoria">Categoría *</label><select id="categoria" name="categoria" required><option value="">Seleccione una categoría</option><?php foreach (['Tecnología', 'Hogar', 'Ropa', 'Accesorios', 'Otros'] as $cat): ?><option value="<?= $cat ?>" <?= (($datos['categoria'] ?? '') === $cat) ? 'selected' : '' ?>><?= $cat ?></option><?php endforeach; ?></select><small class="mensaje-error" id="errorCategoria"></small></div>
                <div class="campo"><label for="precio">Precio (USD) *</label><input type="number" id="precio" name="precio" min="0.01" step="0.01" required value="<?= htmlspecialchars($datos['precio'] ?? '') ?>" placeholder="0.00"><small class="mensaje-error" id="errorPrecio"></small></div>
                <div class="campo"><label for="cantidad">Cantidad *</label><input type="number" id="cantidad" name="cantidad" min="0" step="1" required value="<?= htmlspecialchars($datos['cantidad'] ?? '') ?>" placeholder="0"><small class="mensaje-error" id="errorCantidad"></small></div>
                <div class="campo campo-completo"><label for="descripcion">Descripción</label><textarea id="descripcion" name="descripcion" maxlength="255" rows="5" placeholder="Descripción breve del producto..."><?= htmlspecialchars($datos['descripcion'] ?? '') ?></textarea><div class="contador"><span id="contadorDescripcion">0</span>/255</div><small class="mensaje-error" id="errorDescripcion"></small></div>
            </div>
            <div class="acciones-form"><a class="boton outline" href="index.php">Cancelar</a><button class="boton" type="submit">Guardar producto</button></div>
        </form>
    </section>
</main>
<footer><div class="contenedor footer-flex"><div class="footer-brand"><span>ecotec</span>Store · Universidad Ecotec</div><div>Mike G. Quishpe A.</div></div></footer>
<script src="js/script.js"></script>
</body>
</html>
