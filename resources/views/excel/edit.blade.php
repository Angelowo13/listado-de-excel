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
            <a href="{{ route('listado') }}" class="btn btn-primary me-2">Ver Listado de Información</a>
            <a href="{{ route('subir-excel') }}" class="btn btn-success">Subir Archivo Excel</a>
        </div>
    </div>
</body>
</html>
