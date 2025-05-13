<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('device_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained()->onDelete('cascade');
            $table->decimal('temperature', 5, 2);  // Stores like 25.50 (Celsius)
            $table->decimal('humidity', 5, 2);     // Stores like 65.50 (Percentage)
            $table->decimal('battery', 5, 2)->nullable();  // Optional battery level
            $table->timestamp('recorded_at')->useCurrent();
            $table->timestamps();
            
            $table->index('device_id'); // For better query performance
            $table->index('recorded_at'); // For time-based queries
        });
    }

    public function down()
    {
        Schema::dropIfExists('device_readings');
    }
};