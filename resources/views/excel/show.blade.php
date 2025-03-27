<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Formulario para seleccionar la cantidad de resultados por página -->


<!-- Mostrar los datos generales en una tabla -->
 <div class="container">
<h1>Detalles de Datos Generales</h1>
<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
    
    <tbody>
        <tr>
            <td>Nombre de la Empresa</td>
            <td>{{ $datos->nombre_empresa }}</td>
        </tr>
        <tr>
            <td>Número de Línea</td>
            <td>{{ $datos->numero_linea }}</td>
        </tr>
        <tr>
            <td>Fecha de Consulta</td>
            <td>{{ $datos->fecha_consulta }}</td>
        </tr>
        <tr>
            <td>Moneda</td>
            <td>{{ $datos->moneda }}</td>
        </tr>
        <tr>
            <td>Fecha Desde</td>
            <td>{{ $datos->fecha_desde }}</td>
        </tr>
        <tr>
            <td>Fecha Hasta</td>
            <td>{{ $datos->fecha_hasta }}</td>
        </tr>
        <tr>
            <td>Retenciones</td>
            <td>{{ $datos->retenciones }}</td>
        </tr>
        <tr>
            <td>Monto Autorizado</td>
            <td>{{ $datos->monto_autorizado }}</td>
        </tr>
        <tr>
            <td>Monto Utilizado</td>
            <td>{{ $datos->monto_utilizado }}</td>
        </tr>
        <tr>
            <td>Saldo Disponible</td>
            <td>{{ $datos->saldo_disponible }}</td>
        </tr>
    </tbody>
</table>
</div>
<!-- Mostrar las transacciones relacionadas en una tabla -->

<div class='container'>
<h2>Transacciones Asociadas</h2>
@if($datos->lista->isEmpty())
    <p>No hay transacciones disponibles para estos datos generales.</p>
@else
    <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Sucursal</th>
                <th>Número de Documento</th>
                <th>Cargos</th>
                <th>Abonos</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datos->lista as $transaccion)
                <tr>
                    <td>{{ $transaccion->fecha }}</td>
                    <td>{{ $transaccion->descripcion }}</td>
                    <td>{{ $transaccion->sucursal }}</td>
                    <td>{{ $transaccion->numero_doc }}</td>
                    <td>{{ $transaccion->cargos }}</td>
                    <td>{{ $transaccion->abonos }}</td>
                    <td>{{ $transaccion->saldo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div>
    {{ $datos->lista->appends(request()->query())->links('pagination::bootstrap-5') }}
    
</div>

@endif
<form method="GET" action="{{ route('excel.show', $datos->id) }}">
    <label for="per_page">Resultados por página:</label>
    <select name="per_page" id="per_page" onchange="this.form.submit()">
        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
        <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
    </select>
</form>
<a href="{{ route('excel.index') }}" class="btn btn-primary me-2">volver</a>

<a href="/ " class="btn btn-primary me-2">Ir a inicio</a></div>
</body>
</html>
