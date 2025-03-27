<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $fillable = [
        'datos_generales_id', 'fecha', 'descripcion', 'sucursal',
        'numero_doc', 'cargos', 'abonos', 'saldo'
    ];

    public function datosGenerales()
    {
        return $this->belongsTo(DatosGenerales::class);
    }
}
