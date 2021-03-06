<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLancamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lancamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movimento_id')->nullable();
            $table->foreign('movimento_id')->references('id')->on('movimentos')->onDelete('set null');
            $table->unsignedBigInteger('ficorcamentaria_id')->nullable();
            $table->foreign('ficorcamentaria_id')->references('id')->on('fic_orcamentarias')->onDelete('set null');
            $table->unsignedBigInteger('conta_id')->nullable();
            $table->foreign('conta_id')->references('id')->on('contas')->onDelete('set null');
            $table->string('grupo', 4);
            $table->boolean('receita')->nullable()->default(FALSE);
            $table->date('data');
            $table->integer('empenho');
            $table->string('descricao', 150);
            $table->float('debito', 15, 2);
            $table->float('credito', 15, 2);
            $table->float('saldo', 15, 2);
            $table->boolean('estornado')->nullable()->default(FALSE);
            $table->string('observacao', 150);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('lancamentos');
    }
}
