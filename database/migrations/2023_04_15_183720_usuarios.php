<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('email', 100);
            $table->string('senha', 100);
            $table->string('imagem', 100);
            $table->timestamps();
        });

        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->char('CEP', 9);
            $table->enum('estado', ['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO']);
            $table->string('cidade', 100);
            $table->string('bairro', 100);
            $table->string('logradouro', 100);
            $table->string('rua', 100);
            $table->integer('numero');
            $table->timestamps();
        });

        Schema::create('telefones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->char('numero', 15);
            $table->timestamps();
        });

        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('descricao', 100);
            $table->timestamps();
        });

        Schema::create('doadores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->timestamps();
        });

        Schema::create('ongs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->char('cnpj', 18);
            $table->string('razao_social', 100);
            $table->text('descricao');
            $table->timestamps();
        });

        Schema::create('objetos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doadore_id');
            $table->foreign('doadore_id')->references('id')->on('doadores');
            $table->unsignedBigInteger('ong_id');
            $table->foreign('ong_id')->references('id')->on('ongs');
            $table->string('descricao', 100);
            $table->tinyInteger('estado');
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
        Schema::dropIfExists('ongs');
        Schema::dropIfExists('doadores');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('telefones');
        Schema::dropIfExists('enderecos');
        Schema::dropIfExists('usuarios');
    }
}
