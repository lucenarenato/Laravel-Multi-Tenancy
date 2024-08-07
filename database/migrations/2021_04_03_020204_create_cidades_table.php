<?php

use App\Models\Estado;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cidades', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('ibge');
            $table->unsignedBigInteger('estado_id'); // Campo para chave estrangeira
            $table->foreign('estado_id')->references('id')->on('estados'); // Definindo a chave estrangeira
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
        Schema::table('cidades', function (Blueprint $table) {
            $table->dropForeign(['estado_id']);
            $table->dropColumn('estado_id');
        });

        Schema::dropIfExists('cidades');
    }
}
