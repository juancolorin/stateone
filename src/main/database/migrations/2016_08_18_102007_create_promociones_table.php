<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreatePromocionesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('promociones',function(Blueprint $table){
            $table->increments("id");
            $table->enum("estado", ["Disponible","Vendido", "Alquilado", "Reservado", "Oferta Presentada", "Baja"]);
            $table->enum("operacion", ["Venta", "Alquiler", "Alquiler con opción a compra", "Venta y Alquiler"]);
            $table->string("nombre");
            $table->text("descripcion")->nullable();
            $table->integer("provincias_id")->references("id")->on("provincias")->nullable();
            $table->integer("localidades_id")->references("id")->on("localidades")->nullable();
            $table->integer("zonas_id")->references("id")->on("zonas")->nullable();
            $table->string("latitud")->nullable();
            $table->string("longitud")->nullable();
            $table->integer("tiposinmuebles_id")->references("id")->on("tiposinmuebles");
            $table->decimal("precio", 15, 2)->nullable();
            $table->decimal("precio_min", 15, 2)->nullable();
            $table->string("direccion")->nullable();
            $table->string("cp")->nullable();
            $table->string("dormitorios")->nullable();
            $table->string("banos")->nullable();
            $table->string("aseos")->nullable();
            $table->decimal("m2_salon", 15, 2)->nullable();
            $table->decimal("m2_cocina", 15, 2)->nullable();
            $table->tinyInteger("terraza")->default(0)->nullable();
            $table->tinyInteger("balcon")->default(0)->nullable();
            $table->string("armarios_empotrados")->nullable();
            $table->tinyInteger("garaje_privado")->default(0)->nullable();
            $table->tinyInteger("aparcamiento")->default(0)->nullable();
            $table->tinyInteger("trastero")->default(0)->nullable();
            $table->tinyInteger("ascensor")->default(0)->nullable();
            $table->decimal("m2_construidos", 15, 2)->nullable();
            $table->decimal("m2_utiles", 15, 2)->nullable();
            $table->decimal("m2_parcela", 15, 2)->nullable();
            $table->decimal("m2_terraza", 15, 2)->nullable();
            $table->decimal("m2_patio", 15, 2)->nullable();
            $table->string("plantas")->nullable();
            $table->string("tipo_suelo")->nullable();
            $table->string("climatizacion")->nullable();
            $table->string("ventanas")->nullable();
            $table->string("agua_caliente")->nullable();
            $table->string("cocina")->nullable();
            $table->string("calefacción")->nullable();
            $table->string("aa")->nullable();
            $table->string("ce")->nullable();
            $table->tinyInteger("acepta_animales")->default(1)->nullable();
            $table->tinyInteger("bodega")->default(0)->nullable();
            $table->tinyInteger("buhardilla")->default(0)->nullable();
            $table->tinyInteger("chimenea")->default(0)->nullable();
            $table->tinyInteger("despensa")->default(0)->nullable();
            $table->tinyInteger("sotano")->default(0)->nullable();
            $table->tinyInteger("tendedero")->default(0)->nullable();
            $table->tinyInteger("vestidor")->default(0)->nullable();
            $table->tinyInteger("alarma")->default(0)->nullable();
            $table->tinyInteger("conserje")->default(0)->nullable();
            $table->tinyInteger("domotica")->default(0)->nullable();
            $table->tinyInteger("energia_solar")->default(0)->nullable();
            $table->tinyInteger("jacuzzi")->default(0)->nullable();
            $table->tinyInteger("piscina_privada")->default(0)->nullable();
            $table->tinyInteger("piscina_cubierta")->default(0)->nullable();
            $table->tinyInteger("portero_automatico")->default(0)->nullable();
            $table->tinyInteger("puerta_blindada")->default(0)->nullable();
            $table->tinyInteger("rejas")->default(0)->nullable();
            $table->tinyInteger("solarium")->default(0)->nullable();
            $table->tinyInteger("terraza_cubierta")->default(0)->nullable();
            $table->tinyInteger("piscina_comunitaria")->default(0)->nullable();
            $table->tinyInteger("pista_tenis")->default(0)->nullable();
            $table->tinyInteger("pista_padel")->default(0)->nullable();
            $table->tinyInteger("parque_infantil")->default(0)->nullable();
            $table->tinyInteger("sistema_seguridad")->default(0)->nullable();
            $table->tinyInteger("zonas_verdes")->default(0)->nullable();
            $table->tinyInteger("vigilancia")->default(0)->nullable();
            $table->tinyInteger("publicado")->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('promociones');
    }

}