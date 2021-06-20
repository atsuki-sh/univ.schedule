<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'user_id' => 1,
            'course_index' => 1,
            'title' => '価値創造方法論',
            'note' => 'グループワーク用のパワーポイントを作る',
            'place' => '第三講義室',
            'teacher' => '佐藤健',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('courses')->insert([
            'user_id' => 1,
            'course_index' => 8,
            'title' => '音声データと画像処理分析',
            'note' => '確認テストを受ける。',
            'place' => '第23講義室',
            'teacher' => '長谷川清矢',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('courses')->insert([
            'user_id' => 1,
            'course_index' => 12,
            'title' => 'ゼミ',
            'note' => 'ニュース発表資料を作って練習しておく。',
            'place' => '大合併講義室',
            'teacher' => '川井明',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('courses')->insert([
            'user_id' => 2,
            'course_index' => 8,
            'title' => 'データベース',
            'note' => 'ニュース発表資料を作って練習しておく。',
            'place' => '大合併講義室',
            'teacher' => '谷口誠',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
