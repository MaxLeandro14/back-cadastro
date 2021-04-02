<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Validation\Rule;

class CreateEmpresariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresarios', function (Blueprint $table) {
            /* todos os campos são obrigatórios, excerto 'pai_empresarial', celular único*/
            $table->bigIncrements('id');
            $table->string('nome')->unsigned();
            $table->string('estado')->unsigned();
            $table->string('cidade')->unsigned();
            $table->bigInteger('telefone')->unsigned();
            $table->string('nome_pai')->nullable();
            $table->integer('pai_empresarial')->nullable();
            $table->foreign('pai_empresarial')->references('id')->on('empresarios')->onDelete('cascade');
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
        Schema::dropIfExists('empresarios');
    }
}
