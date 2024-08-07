<?php

use App\Models\Pessoa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('documento');
            $table->string('orgao_emissor')->nullable();
            $table->date('data_emissao')->nullable();
            $table->unsignedBigInteger('pessoa_id'); // Campo para chave estrangeira
            $table->foreign('pessoa_id')->references('id')->on('pessoas'); // Definindo a chave estrangeira
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
        Schema::table('documentos', function (Blueprint $table) {
            $table->dropForeign(['pessoa_id']);
            $table->dropColumn('pessoa_id');
        });

        Schema::dropIfExists('documentos');
    }
}
