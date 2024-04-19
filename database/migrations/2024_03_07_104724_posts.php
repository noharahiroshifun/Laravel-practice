<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;//追加箇所
// use宣言...このファイル内部で使用したいクラスや関数、定数などを、他のファイルからインポート（持ってきて使う）するために使用
// 「Illuminate\Support\Facades\DB;」...「DB」クラスが定義されているファイルまでのパス →これでDBクラスが使える様に

class Posts extends Migration
    // Postsという名前のクラスを定義　PostsにMigrationクラスを継承
// →migration（テーブルの作成、変更、削除）が可能に
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() // テーブルを作成するためのメソッド
    // migrationによって最初から自動で記述されている
    // ※テーブルの作成や変更を行うための指示を書く場所の用意。
    {
        // ===テーブルに関する指示内容====
        Schema::create('posts', function (Blueprint $table) {// 実際にテーブルを作成するためのメソッド
            // Schemaクラス...DBの設計図の様なもの。データの洗い出し、整理などのルールを決める。テーブルよりも大きい枠組み
            // create...「''」に指定された名前のテーブルを作成するメソッド
            //  2つの引数を受け取る。1.作成するテーブルの名前  2.テーブルの構造を定義するクロージャ（無名関数）
            // function (Blueprint $table)...クロージャ（無名関数）のこと。テーブルの構造を定義している。

            // （）内がカラム名
            $table->increments('id');
            // increments...自動で１増加した数字を格納するカラムを作成するメソッド
            // 11...指定長さ
           $table->string('user_name', 255); // 'user_name' カラムにデフォルト値を設定
            // string...文字列型のカラムを作成するメソッド
            // 255...指定長さ　※255文字が余分なデータを使わず効率的にデータを保存できる
            // user_nameカラムにデフォルト値が設定されていないとエラーが起きる
            $table->string('contents', 255);// 投稿内容を保存するカラムを追加

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            // timestamp...日時を格納するカラムを作成するメソッド
            // ->default(DB::raw('CURRENT_TIMESTAMP'));...データベースの今の日時を表す
            // → created_atという名前のタイムスタンプ型のカラムを作成し、そのデフォルト値をレコードが作成された日時に設定する
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        // 更新した日時を格納するカラムを作成するメソッド
        //    $table->foreign('user_id')->references('id')->on('users');
        // 外部キー制約　chatGPT参照だがいらない？



        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        // useテーブルとpostテーブル２つあるけどどう作成すればいい？
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('posts');
        // テーブル削除のための命名
    }
}
