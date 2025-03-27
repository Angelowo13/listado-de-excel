<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatosGenerales extends Model
{
    protected $fillable = [
        'nombre_empresa', 'numero_linea', 'fecha_consulta', 'moneda',
        'fecha_desde', 'fecha_hasta', 'retenciones', 'monto_autorizado',
        'monto_utilizado', 'saldo_disponible'
    ];

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }
}
