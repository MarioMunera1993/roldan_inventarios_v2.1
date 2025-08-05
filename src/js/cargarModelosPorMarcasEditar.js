document.addEventListener('DOMContentLoaded', function() {
  const marcaSelect = document.getElementsByName('IdMarca')[0];
  const modeloSelect = document.getElementById('idModelo');

  function cargarModelos(idMarca, selectedIdModelo = null) {
    modeloSelect.innerHTML = '<option value="">Cargando...</option>';
    fetch('../apiModelos.php?IdMarca=' + encodeURIComponent(idMarca))
      .then(res => res.json())
      .then(data => {
        let options = '<option value="">Seleccione Modelo</option>';
        data.forEach(function(modelo) {
          let selected = (selectedIdModelo && modelo.IdModelo == selectedIdModelo) ? 'selected' : '';
          options += `<option value="${modelo.IdModelo}" ${selected}>${modelo.NombreModelo}</option>`;
        });
        modeloSelect.innerHTML = options;
      });
  }

  if (marcaSelect && modeloSelect) {
    marcaSelect.addEventListener('change', function() {
      if (this.value) {
        cargarModelos(this.value);
      } else {
        modeloSelect.innerHTML = '<option value="">Seleccione Modelo</option>';
      }
    });
  }
});