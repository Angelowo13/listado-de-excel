<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
</head>
<body>
    <div class="container mt-5">
    <div> 
    <a href="/ " class="btn btn-primary me-2"><-- Ir a inicio</a></div>
    <br>
        <form id="upload-form" action="{{ route('excel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="file" name="archivo_excel" accept=".xlsx,.xls" id="archivo_excel" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary" style="display: none;">Importar</button>
        </form>

        <h3 class="mt-4">Previsualización del archivo Excel</h3>
        <table id="excel-preview" class="table table-bordered" style="display: none;">
       
            <tbody>
                <!-- Aquí se insertarán los datos del archivo Excel -->
            </tbody>
        </table>
    </div>

    <script>
document.getElementById('archivo_excel').addEventListener('change', function(event) {
    // Obtén el archivo
    var archivo = event.target.files[0];
    
    if (archivo) {
        // Crear un lector de archivos
        var reader = new FileReader();
        
        // Evento cuando el archivo ha sido leído
        reader.onload = function(e) {
            // Leer el contenido del archivo Excel
            var data = e.target.result;
            var workbook = XLSX.read(data, { type: 'binary' });
            
            // Obtener la primera hoja del archivo Excel
            var sheet = workbook.Sheets[workbook.SheetNames[0]];
            
            // Convertir la hoja a un array de JSON
            var rows = XLSX.utils.sheet_to_json(sheet, { header: 1 });

            // Formato esperado (solo los nombres de las columnas)
            const formatoEsperado = [
                "Nombre Empresa",
                "Número Línea",
                "Fecha Consulta",
                "Moneda",
                "Fecha Desde",
                "Fecha Hasta"
            ];

            // Validar las primeras filas contra el formato esperado
            let valido = true;
            for (let i = 0; i < formatoEsperado.length; i++) {
                if (!rows[i] || rows[i][0] !== formatoEsperado[i]) {
                    valido = false;
                    break;
                }
            }

            if (!valido) {
                alert("El archivo no cumple con el formato esperado. Verifique las primeras filas.");
                return;
            }

            // Mostrar el archivo Excel en la tabla
            var table = document.getElementById('excel-preview');
            var tbody = table.getElementsByTagName('tbody')[0];
            tbody.innerHTML = ''; // Limpiar cualquier contenido previo

            // Iterar sobre las filas y agregar los datos a la tabla
            rows.forEach(function(row, index) {
                var tr = document.createElement('tr');

                // Iterar sobre las celdas, para asegurar que cada columna se muestra
                for (var i = 0; i < row.length; i++) {
                    var td = document.createElement('td');
                    td.textContent = row[i] !== undefined ? row[i] : ''; // Si la celda está vacía, mostramos un espacio vacío
                    tr.appendChild(td);
                }
                
                tbody.appendChild(tr);
            });

            // Mostrar la tabla de previsualización
            table.style.display = 'table';

            // Mostrar el botón de enviar después de previsualizar
            document.getElementById('upload-form').querySelector('button').style.display = 'inline';
        };

        // Leer el archivo Excel como binario
        reader.readAsBinaryString(archivo);
    }
});
</script>

</body>
</html>
