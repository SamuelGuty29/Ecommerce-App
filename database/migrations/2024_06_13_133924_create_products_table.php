<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->text('description')->nullable();
			$table->double('price');
			$table->integer('stock');
			$table->bigInteger('category_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
		});
	}


	public function down()
	{
		Schema::dropIfExists('products');
	}
};
