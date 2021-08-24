<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetos', function (Blueprint $table) {
            $table->id();

            $table->string('nome');
            $table->string('descricao');
            $table->smallInteger('entregue');
            $table->text('imagem_objeto')->nullable();

            $table->unsignedBigInteger('local_id');
            $table->foreign('local_id')
                  ->references('id')->on('locais')->cascadeOnDelete();

            $table->string('dono_nome')->nullable();
            $table->string('dono_cpf')->nullable();

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
        Schema::dropIfExists('objetos');
    }
}
