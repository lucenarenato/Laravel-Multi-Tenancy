<?php

use App\Models\Cidade;
use App\Models\Pessoa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->boolean('principal');
            $table->string('endereco');
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('referencia')->nullable();
            $table->integer('cep')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('pessoa_id'); // Campo para chave estrangeira
            $table->foreign('pessoa_id')->references('id')->on('pessoas'); // Definindo a chave estrangeira

            $table->unsignedBigInteger('cidade_id'); // Campo para chave estrangeira
            $table->foreign('cidade_id')->references('id')->on('cidades'); // Definindo a chave estrangeira
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->dropForeign(['pessoa_id']);
            $table->dropColumn('pessoa_id');

            $table->dropForeign(['cidade_id']);
            $table->dropColumn('cidade_id');
        });

        Schema::dropIfExists('enderecos');
    }
}
