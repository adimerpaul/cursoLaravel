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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            // nota_id producto_id almacen_id cantidad tipo_movimiento precio_unitario_compra precio_unitario_venta observaciones
            $table->foreignId('nota_id')->constrained('notas')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->foreignId('almacen_id')->constrained('almacenes')->onDelete('cascade');
            $table->integer('cantidad');
            $table->string('tipo_movimiento'); // entrada o salida
            $table->decimal('precio_unitario_compra', 10, 2)->nullable();
            $table->decimal('precio_unitario_venta', 10, 2)->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
