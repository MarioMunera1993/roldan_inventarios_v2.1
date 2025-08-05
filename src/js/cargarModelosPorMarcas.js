document.addEventListener('DOMContentLoaded', function() {
  const marcaSelect = document.getElementById('IdMarca');
  const modeloSelect = document.getElementById('IdModelo');

  function cargarModelos(idMarca) {
    modeloSelect.innerHTML = '<option value="">Cargando...</option>';
    fetch('../apiModelos.php?IdMarca=' + encodeURIComponent(idMarca))
      .then(res => res.json())
      .then(data => {
        let options = '<option value="">Seleccione Modelo</option>';
        data.forEach(function(modelo) {
          options += `<option value="${modelo.IdModelo}">${modelo.NombreModelo}</option>`;
        });
        modeloSelect.innerHTML = options;
      });
  }

  marcaSelect.addEventListener('change', function() {
    if (this.value) {
      cargarModelos(this.value);
    } else {
      modeloSelect.innerHTML = '<option value="">Seleccione Modelo</option>';
    }
  });
});