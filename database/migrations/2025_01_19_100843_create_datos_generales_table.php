<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('datos_generales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empresa');
            $table->string('numero_linea');
            $table->date('fecha_consulta');
            $table->string('moneda');
            $table->date('fecha_desde');
            $table->date('fecha_hasta');
            $table->decimal('retenciones', 15, 2)->default(0);
            $table->decimal('monto_autorizado', 15, 2)->default(0);
            $table->decimal('monto_utilizado', 15, 2)->default(0);
            $table->decimal('saldo_disponible', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_generales');
    }
};
