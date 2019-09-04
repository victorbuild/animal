<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToAnimals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('animals', function (Blueprint $table) {
            // 增加 user_id 欄位 （這裡要注意 先把這個欄位設定為 users 資料表中的任一個已存在的會員id ）
            $table->bigInteger('user_id')->unsigned()->default(1)->comment('使用者ID');

            // 新增外鍵約束 如果user id:1 刪除 animal user_id = 1 也會全部刪除
            $table->foreign('user_id')
                ->references('id')->on('users')
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

        Schema::table('animals', function (Blueprint $table) {
            // 刪除外鍵約束 （這個表名_外鍵名_foreign）
            $table->dropForeign('animals_user_id_foreign');

            //刪除user_id 欄位
            $table->dropColumn('user_id');
        });

    }
}
