<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateClientesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('clientes',function(Blueprint $table){
            $table->increments("id");
            $table->integer("user_id")->references("id")->on("user")->nullable();
            $table->dateTime("fecha_ingreso")->nullable();
            $table->enum("medio_captacion", ["Web", "Oficina", "Teléfono", "Publicidad", "Otros"])->nullable();
            $table->string("name");
            $table->string("email")->nullable();
            $table->string("telefono")->nullable();
            $table->string("document_number")->nullable();
            $table->string("province")->nullable();
            $table->string("town")->nullable();
            $table->string("cp")->nullable();
            $table->text("observaciones")->nullable();
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
        Schema::drop('clientes');
    }

}