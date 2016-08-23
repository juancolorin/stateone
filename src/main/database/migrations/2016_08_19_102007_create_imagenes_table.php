<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateImagenesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('imagenes',function(Blueprint $table){
            $table->increments("id")->unsigned();
            $table->integer("promocion_id")->unsigned();
            $table->string("name");
            $table->string("image");
            $table->tinyInteger("publicada")->default(0)->nullable();
            $table->foreign('promocion_id')->references('id')->on('promociones')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::drop('imagenes');
    }

}