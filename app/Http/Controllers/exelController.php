<?php

namespace App\Http\Controllers;
use App\Models\DatosGenerales;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class exelController extends Controller
{
    public function index()
    {   
        $datos=DatosGenerales::all();
        foreach($datos as $dato){
            $dato->cantidad=Transaccion::where('datos_generales_id','=',$dato->id)->count();
        }

        return view('excel.index',compact('datos'));
    }
    public function create()
    {
        return view('excel.create');
    }
    public function store(Request $request)
    {
        $archivo = $request->file('archivo_excel');

    if ($archivo) {
        $spreadsheet = IOFactory::load($archivo->getPathname());
        $hoja = $spreadsheet->getActiveSheet();
        $datos = $hoja->toArray();

        // 1. Guardar datos generales
        $datosGenerales = DatosGenerales::create([
            'nombre_empresa' => $datos[0][1],
            'numero_linea' => $datos[1][1],
            'fecha_consulta' => Carbon::createFromFormat('d-m-Y', $datos[2][1])->format('Y-m-d'),
            'moneda' => $datos[3][1],
            'fecha_desde' => Carbon::createFromFormat('d-m-Y', $datos[4][1])->format('Y-m-d'),
            'fecha_hasta' => Carbon::createFromFormat('d-m-Y', $datos[5][1])->format('Y-m-d'),
            'retenciones' => $datos[6][1],
            'monto_autorizado' => $datos[7][1],
            'monto_utilizado' => $datos[8][1],
            'saldo_disponible' => $datos[9][1],
        ]);

        // 2. Guardar transacciones
        for ($i = 12; $i < count($datos); $i++) {
            Transaccion::create([
                'datos_generales_id' => $datosGenerales->id,
                'fecha' => Carbon::createFromFormat('d-m-Y', $datos[$i][0])->format('Y-m-d'),
                'descripcion' => $datos[$i][1],
                'sucursal' => $datos[$i][2],
                'numero_doc' => $datos[$i][3],
                'cargos' => is_numeric($datos[$i][4]) && !empty($datos[$i][4]) ? floatval($datos[$i][4]) : 0,  // Validación para cargos
                'abonos' => is_numeric($datos[$i][5]) && !empty($datos[$i][5]) ? floatval($datos[$i][5]) : 0,  // Validación para abonos
                'saldo' => is_numeric($datos[$i][6]) && !empty($datos[$i][6]) ? floatval($datos[$i][6]) : 0,  // Validación para saldo
            ]);
        }

        return redirect()->route('excel.index')->with('mensaje', 'Datos importados correctamente');

    }

    return response()->json(['mensaje' => 'Error al cargar el archivo'], 400);
    }
    
    public function show($id, Request $request)
{
    // Obtener la cantidad de resultados por página, con un valor predeterminado de 5
    $perPage = $request->input('per_page', 5);  // Por defecto 5

    // Validar si la cantidad es un número válido
    if (!in_array($perPage, [5, 10, 15])) {
        $perPage = 5; // Si no es 5, 10 ni 15, usar 5 por defecto
    }

    // Obtener los datos generales por ID
    $datos = DatosGenerales::where('id', $id)->firstOrFail();
    
    // Obtener las transacciones asociadas con la paginación
    $datos->lista = Transaccion::where('datos_generales_id', '=', $id)->paginate($perPage);
    
    // Retornar la vista con los datos
    return view('excel.show', compact('datos'));
}

    public function edit($path)
    {

    }
    public function update(Request $request, $path)
    {
        
    }

    public function destroy($id)
{
    // Obtener los datos generales por ID, si no existe lanza un error 404
    $datos = DatosGenerales::findOrFail($id);

    // Eliminar las transacciones asociadas
    Transaccion::where('datos_generales_id', $id)->delete();

    // Eliminar los datos generales
    $datos->delete();

    // Redirigir al índice con un mensaje de éxito
    return redirect()->route('excel.index')->with('mensaje', 'Datos eliminados correctamente');
}
   
    
}
