<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
        public function run()
    {
        $this->call([
            // UsersTableSeeder::class,
            PostsTableSeeder::class,
        ]);
        // データベースに入っている初期データを自動で追加
        // 設計資料をもとに、usersテーブル・postsテーブルの２つ分追加　chatGPT参照
    }

}
