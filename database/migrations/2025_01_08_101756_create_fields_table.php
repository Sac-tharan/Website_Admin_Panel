<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
	{
		Schema::create('fields', function (Blueprint $table) {
			$table->increments('id');
			$table->enum('belongs_to', ['posts', 'users']);
			$table->text('name')->nullable();
			$table->string('type', 50)->default('text');
			$table->integer('max')->unsigned()->nullable()->default('255');
			$table->text('default_value')->nullable();
			$table->boolean('required')->unsigned()->nullable();
			$table->boolean('active')->unsigned()->nullable();
			$table->index(["belongs_to"]);
			$table->index(["active"]);
		});
	}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fields');
    }
};
