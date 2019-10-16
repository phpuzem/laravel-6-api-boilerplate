<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('character_id');
            $table->integer('health')->index()->nullable();
            $table->integer('mana')->index()->nullable();
            $table->integer('attack_power')->index()->nullable();
            $table->integer('defence')->index()->nullable();
            $table->integer('magic_power')->index()->nullable();
            $table->integer('intelligence')->index()->nullable();
            $table->integer('agility')->index()->nullable();
            $table->integer('resistance')->index()->nullable();
            $table->integer('level')->index()->nullable();
            $table->integer('level_percentage')->index()->nullable();

            $table->timestamps();
        });

        Schema::table('stats', function (Blueprint $table) {
            $table->foreign('character_id')
                ->references('id')
                ->on('characters')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stats');
    }
}
