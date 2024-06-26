<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) { //0419修正追加
            $table->integer('id', 11);
            $table->string('name',255);
            $table->string('email',255)->unique();
            // unique...一意性追加 同じ内容での登録ができなくなる
            $table->timestamp('create_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('password',255);
            $table->rememberToken();
            $table->timestamps('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
