<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
	{
    		Schema::create('user_cromos', function (Blueprint $table) {
        		$table->id();
        		$table->foreignId('user_id')->constrained()->cascadeOnDelete();
        		$table->string('grupo', 1);
        		$table->string('seleccion', 3);
        		$table->unsignedSmallInteger('numero');
        		$table->unsignedTinyInteger('cantidad')->default(1);
        		$table->unique(['user_id', 'seleccion', 'numero']);
        		$table->timestamps();
    		});
	}

	public function down(): void
	{
    		Schema::dropIfExists('user_cromos');
	}
};
