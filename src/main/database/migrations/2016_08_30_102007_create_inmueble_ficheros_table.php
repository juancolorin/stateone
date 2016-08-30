<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateInmuebleFicherosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
	    Schema::create('inmueble_ficheros', function(Blueprint $table)
	    {
	        $table->increments('id');
	        $table->boolean('is_active')->default(false);
	        $table->boolean('is_featured')->default(false);
	        $table->string('image_name');
	        $table->string('title');
	        $table->string('image_path');
	        $table->string('image_extension', 10);
	        $table->string('mobile_image_name');
	        $table->string('mobile_image_path');
	        $table->string('mobile_extension', 10);
	        $table->integer("inmueble_id")->unsigned();
	        $table->foreign('inmueble_id')->references('id')->on('inmuebles')->onDelete('CASCADE')->onUpdate('CASCADE');
	        $table->timestamps();
	    });
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inmueble_ficheros');
    }

}