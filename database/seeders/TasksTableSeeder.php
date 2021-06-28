<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'user_id' => 1,
            'course_index' => 1,
            'title' => 'レポート提出',
            'course' => '価値創造方法論',
            'note' => '提出はwordファイル',
            'due_date' => Carbon::now()->addDay(3),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tasks')->insert([
            'user_id' => 1,
            'course_index' => 8,
            'title' => 'レポート提出',
            'course' => '音声データと画像処理分析',
            'note' => '提出はメールで送信',
            'due_date' => Carbon::now()->addDay(6),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
