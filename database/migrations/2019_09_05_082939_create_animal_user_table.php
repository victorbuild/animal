<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('animal_id')->unsigned()->comment('動物ID');
            $table->bigInteger('user_id')->unsigned()->comment('使用者ID');
            $table->timestamps();
        });

        // Schema::table 訪法來對上面建立好的資料表 新增外鍵約束
        Schema::table('animal_user', function (Blueprint $table) {

            // user_id 外鍵
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            // animal_id 外鍵
            $table->foreign('animal_id')
                ->references('id')->on('animals')
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
        Schema::table('animal_user', function (Blueprint $table) {
            // 刪除外鍵約束 （這個表名_外鍵名_foreign）
            $table->dropForeign('animal_user_user_id_foreign');
            $table->dropForeign('animal_user_animal_id_foreign');
        });

        Schema::dropIfExists('animal_user');
    }
}
