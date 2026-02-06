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
        Schema::create('clients', function (Blueprint $table) {
            $table->id(); // ID único (1, 2, 3...)

            // --- AQUÍ AGREGAMOS TUS DATOS ---
            $table->string('name');              // Nombre completo
            $table->string('company')->nullable(); // Empresa (nullable = puede dejarse vacío)
            $table->string('email')->nullable();   // Correo electrónico
            $table->string('phone')->nullable();   // Teléfono
            $table->string('status')->default('Activo'); // Estado por defecto

            // Si quieres guardar quién registró al cliente (opcional pero recomendado en CRMs)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps(); // Fecha de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
