<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuestionsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions =[
            [
                'id'=>1,
                'question'=>'هل  ؟؟',
                'question_recommendation'=>'هل برضه ؟ ',
                'year_id'=>'1',
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id'=>2,
                'question'=>'هل 2 ؟؟',
                'question_recommendation'=>'هل 2برضه ؟ ',
                'year_id'=>'2',
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            ],

        ];
        \App\Starter\Questions\Question::insert($questions);
    }

}
