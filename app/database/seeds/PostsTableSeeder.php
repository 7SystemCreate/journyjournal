<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            [
                'title' => '部屋露天風呂・夕朝食付き！',
                'date' => '2024-01-01',
                'max_people' => 4,
                'comment' => 'お部屋に露天風呂、その他アメニティあります。食事の内容は変更可能です。',
                'image' => 'xxxxx-xxxxxx',
                'amount' => 30000,
                'booking_flg' => 0,
                'del_flg' => 0,
                'report_flg' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => '格安・朝食なし',
                'date' => '2024-02-01',
                'max_people' => 4,
                'comment' => '夕食のみのコースです。食事の内容は変更可能です。',
                'image' => 'xxxxx-xxxxxx',
                'amount' => 10000,
                'booking_flg' => 0,
                'del_flg' => 0,
                'report_flg' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => '部屋露天風呂・朝食なし',
                'date' => '2024-03-01',
                'max_people' => 4,
                'comment' => 'お部屋に露天風呂・その他アメニティあります。夕食のみのコースです。食事の内容は変更可能です。',
                'image' => 'xxxxx-xxxxxx',
                'amount' => 20000,
                'booking_flg' => 0,
                'del_flg' => 0,
                'report_flg' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        foreach($params as $param) {
            DB::table('Posts')->insert($param);
        }
    }
}
