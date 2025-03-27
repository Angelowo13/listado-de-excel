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
        Schema::create('transaccions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('datos_generales_id')->constrained('datos_generales')->onDelete('cascade');
            $table->date('fecha');
            $table->string('descripcion');
            $table->string('sucursal')->nullable();
            $table->string('numero_doc')->nullable();
            $table->decimal('cargos', 15, 2)->default(0);
            $table->decimal('abonos', 15, 2)->default(0);
            $table->decimal('saldo', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaccions');
    }
};
