<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;// posts.php同様に追加

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //以下追加

        DB::table('posts')->insert([

            ['user_name' => 'ユーザー名1', 'contents' => '投稿例1'], // 投稿データを追加
            ['user_name' => 'ユーザー名2', 'contents' => '投稿例2'], // 別の投稿データを追加

        // ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
        // 投稿時にidと投稿内容以外に指定はある？　質問したい
        // ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
        ]);
    }
}
