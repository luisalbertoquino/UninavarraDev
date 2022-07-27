<div class="form">
  
    <ul class="tab-group">
      <li class="tab active"><a href="#assistants">Asistentes</a></li>
      <li class="tab"><a href="#speakers">Ponentes</a></li>
    </ul>
    
    <div class="tab-content">
      <div id="assistants">   
        <h1>Certificados Asistentes</h1>
        
        <form id="form-assistants">

        <div class="field-wrap">
          <label>
            Digite su cédula<span class="req">*</span>
          </label>
          <input id="cedula" type="number"required autocomplete="off"/>
        </div>
        
        <button id="submit" type="submit" class="button button-block"/>Descargar Certificado</button>
        
        </form>

      </div>
      
      <div id="speakers">   
        <h1>Certificados Ponentes</h1>
        
        <form action="/" method="post">
        
          <div class="field-wrap">
          <label>
            Digite su cédula<span class="req">*</span>
          </label>
          <input type="number"required autocomplete="off"/>
        </div>
        
        <button class="button button-block" disabled="true"/>Descargar Certificado</button>
        
        </form>

      </div>
      
    </div><!-- tab-content -->
    
</div> <!-- /form -->

<script>
  async function getCSVFByDocId(id, rango, key) {
  let url = `https://sheets.googleapis.com/v4/spreadsheets/${id}/values/${rango}?key=${key}`;
  const response = await fetch(url);
  return response.json();
}

function procesaDatosAJSON(infoJson) {
  let entries = infoJson.values;
  let numFilas = entries.length;

  //Procesamos los datos
  let campos = [];
  let datos = [];

  for(var f = 0; f < numFilas; f++) {
      let fila = entries[f];
      //Recorremos cada fila y por cada columna creamos un nuevo objeto
      let obj = {};

      for(var c = 0; c < fila.length; c++) {
          celda = fila[c];
          if (f == 0){
              // Nombres de los campos ubicados en el thead
              campos.push(celda);
          } else {
              //En las demás filas asignamos la propiedad que corresponda según la posición
              obj[campos[c]] = celda;
          }
      }
  
      //Añadimos el nuevo objeto a la colección de datos (si no es la primera fila)
      if (f > 0) datos.push(obj);
  }

  return datos;
}

function datos(datos) {
  let cedula = jQuery("#cedula");

  for (let item of datos) {  
    if (cedula.val() == item.cedula) {
      var name = item.nombre
    }
  }

  if (name) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo esc_url(plugins_url('includes/pdf.php', __DIR__)) ?>' + '?name=' + name, true);
    xhr.responseType = 'blob';

    xhr.onload = function(e) {
      
      if (this.status == 200) {
        var blob = new Blob([this.response], {type: 'application/pdf'});
        var link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = "certificado.pdf"; 
        link.click();
        cedula.val("");
        jQuery("label").removeClass('active highlight');   
      }
    };
  
    xhr.send(); 
  } else {
    alert("Su cédula no fue encontrada");
    cedula.val("");
    jQuery("label").removeClass('active highlight'); 
  } 
}

jQuery(document).on('submit','#form-assistants', function(e) {
  e.preventDefault();
  
  getCSVFByDocId('1miTGKBVqNhbfAmqAgyJE4IFNS9zKcdYIO-ePHdRDrYY', 'A:Z', 'AIzaSyBnk4I7IbLq1GV4wVuIypF6lAXijdVknSw').then(procesaDatosAJSON).then(datos);
});
</script>