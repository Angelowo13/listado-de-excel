<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="mx-3 mt-5">
<div> 
<a href="/ " class="btn btn-primary me-2"><-- Ir a inicio</a></div>

@if(session('mensaje'))
    <div class="alert alert-success">
        {{ session('mensaje') }}
    </div>
@endif
    <h1>Listado de Datos</h1>
    @if ($datos->isEmpty())
        <div class="alert alert-warning">
            No hay datos disponibles.
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Empresa</th>
                    <th>Número Línea</th>
                    <th>Fecha Consulta</th>
                    <th>Moneda</th>
                    <th>Fecha Desde</th>
                    <th>Fecha Hasta</th>
                    <th>Retenciones</th>
                    <th>Monto Autorizado</th>
                    <th>Monto Utilizado</th>
                    <th>Saldo Disponible</th>
                    <th>Cantidad</th>
                    <th>Accion</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>{{ $dato->id }}</td>
                        <td>{{ $dato->nombre_empresa }}</td>
                        <td>{{ $dato->numero_linea }}</td>
                        <td>{{ $dato->fecha_consulta }}</td>
                        <td>{{ $dato->moneda }}</td>
                        <td>{{ $dato->fecha_desde }}</td>
                        <td>{{ $dato->fecha_hasta }}</td>
                        <td>{{ $dato->retenciones }}</td>
                        <td>{{ $dato->monto_autorizado }}</td>
                        <td>{{ $dato->monto_utilizado }}</td>
                        <td>{{ $dato->saldo_disponible }}</td>
                        <td>{{ $dato->cantidad }}</td>
                        <td>
                        <a href="{{ route('excel.show', $dato->id) }}" class="btn btn-primary me-2">Ver Detalles</a>
                        <!--  <a href="{{ route('excel.edit', $dato->id) }}" class="btn btn-primary me-2">Editar</a>-->
                        <form action="{{ route('excel.destroy', $dato->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar estos datos?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form></td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif


    </div>
</body>
</html>
