<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   <div class="container mt-5">
    <h1 class="text-center">Sistema de Carga de Archivos Excel</h1>
    <div class="d-flex justify-content-center mt-4">
        <div class="row">
            <div class="col-md-6 text-center mb-4">
                <img src="https://img.freepik.com/vector-premium/mano-que-sostiene-documento-papel-portapapeles-hoja-blanca_81894-7037.jpg" alt="Imagen 1" class="img-fluid" style="height: 200px; object-fit: cover;">
                <a href="{{ route('excel.index') }}" class="btn btn-primary me-2 mt-3">Ver Listado de Información</a>
            </div>
            <div class="col-md-6 text-center mb-4">
                <div>
                <img src="https://www.shutterstock.com/image-vector/modern-flat-design-logo-xls-600nw-2058695381.jpg" alt="Imagen 2" class="img-fluid" style="height: 200px; object-fit: cover;">

                </div>
                <a href="{{ route('excel.create') }}" class="btn btn-success mt-3">Subir Archivo Excel</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
