document.addEventListener('DOMContentLoaded', () => {
    // Menú desplegable de productos
    const toggle = document.getElementById('productosToggle');
    const dropdown = document.getElementById('productosDropdown');

    if (toggle && dropdown) {
        const cerrarDropdown = () => {
            dropdown.classList.remove('abierto');
            toggle.classList.remove('activo');
            toggle.setAttribute('aria-expanded', 'false');
        };

        toggle.addEventListener('click', (event) => {
            event.stopPropagation();
            const abierto = dropdown.classList.toggle('abierto');
            toggle.classList.toggle('activo', abierto);
            toggle.setAttribute('aria-expanded', String(abierto));
        });

        dropdown.addEventListener('click', (event) => event.stopPropagation());

        document.addEventListener('click', cerrarDropdown);

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') cerrarDropdown();
        });
    }

    
    const form = document.getElementById('formProducto');
    const descripcion = document.getElementById('descripcion');
    const contador = document.getElementById('contadorDescripcion');

    if (descripcion && contador) {
        const actualizarContador = () => {
            contador.textContent = descripcion.value.length;
        };
        descripcion.addEventListener('input', actualizarContador);
        actualizarContador();
    }

    if (form) {
        form.addEventListener('submit', (event) => {
            limpiarErrores();

            const nombre = document.getElementById('nombre').value.trim();
            const categoria = document.getElementById('categoria').value;
            const precio = document.getElementById('precio').value.trim();
            const cantidad = document.getElementById('cantidad').value.trim();
            const descripcionValor = descripcion ? descripcion.value.trim() : '';
            let valido = true;

            if (nombre.length < 3 || nombre.length > 100) {
                mostrarError('errorNombre', 'El nombre debe tener entre 3 y 100 caracteres.');
                valido = false;
            }

            if (categoria === '') {
                mostrarError('errorCategoria', 'Selecciona una categoría.');
                valido = false;
            }

            if (precio === '' || Number.isNaN(Number(precio)) || Number(precio) <= 0) {
                mostrarError('errorPrecio', 'Ingresa un precio numérico mayor que 0.');
                valido = false;
            }

            if (cantidad === '' || !Number.isInteger(Number(cantidad)) || Number(cantidad) < 0) {
                mostrarError('errorCantidad', 'Ingresa una cantidad entera igual o mayor que 0.');
                valido = false;
            }

            if (descripcionValor.length > 255) {
                mostrarError('errorDescripcion', 'La descripción no puede superar 255 caracteres.');
                valido = false;
            }

            if (!valido) event.preventDefault();
        });
    }

    document.querySelectorAll('[data-confirmar]').forEach((enlace) => {
        enlace.addEventListener('click', (event) => {
            if (!window.confirm(enlace.dataset.confirmar)) {
                event.preventDefault();
            }
        });
    });

    function mostrarError(id, mensaje) {
        const elemento = document.getElementById(id);
        if (elemento) elemento.textContent = mensaje;
    }

    function limpiarErrores() {
        document.querySelectorAll('.mensaje-error').forEach((elemento) => {
            elemento.textContent = '';
        });
    }
});


// Mantener al usuario en la sección de inventario después de realizar una búsqueda.
document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    const inventario = document.getElementById('inventario');

    if (params.has('q') && inventario) {
        // Esperamos al renderizado para que el navegador pueda ubicar correctamente la sección.
        requestAnimationFrame(() => {
            inventario.scrollIntoView({ behavior: 'instant', block: 'start' });
        });
    }
});
