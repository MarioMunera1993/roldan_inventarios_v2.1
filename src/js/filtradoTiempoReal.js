document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('SearchInput');
    const tablaComputadores = document.getElementById('MainTable');
    const filas = tablaComputadores.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

    // Función para filtrar
    function filtrar(termino) {
        termino = termino.toLowerCase();

        Array.from(filas).forEach(fila => {
            let encontrado = false;
            // Obtener todas las celdas excepto la última (columna de acciones)
            const celdas = Array.from(fila.getElementsByTagName('td')).slice(0, -1);

            // Buscar en cada celda de la fila
            celdas.forEach(celda => {
                const texto = celda.textContent.toLowerCase();
                if (texto.includes(termino)) {
                    encontrado = true;
                }
            });

            // Mostrar u ocultar la fila según si se encontró el término
            fila.style.display = encontrado ? '' : 'none';
        });
    }

    // Evento de búsqueda con debounce para mejor rendimiento
    let timeoutId;
    searchInput.addEventListener('input', function() {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => {
            filtrar(this.value);
        }, 300); // Espera 300ms después de que el usuario deja de escribir
    });

    // Limpiar búsqueda cuando se presiona Escape
    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Escape') {
            this.value = '';
            filtrar('');
        }
    });
});