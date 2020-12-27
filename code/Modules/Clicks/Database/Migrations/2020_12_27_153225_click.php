<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Click extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('click', function (Blueprint $table) {
            $table->string('id', 255)->unique();
            $table->string('ua', 1024)->comment('user-agent');
            $table->string('ip', 16)->comment('IP пользователя');
            $table->string('ref', 255)->comment('Referrer. Сайт откуда пришел пользователь');
            $table->string('param1', 255)->nullable();
            $table->string('param2', 255)->nullable();
            $table->integer('error')->default(0)->comment('Количество ошибок');
            $table->integer('bad_domain')->default(0)->comment('Признак, что клик с плохого домена');

            $table->index('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('click');
    }
}
