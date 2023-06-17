<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quiz = new \App\Models\Quiz([
            'title' => 'Auto Quiz',
            'content' => 'Test je kennis over auto\'s',
        ]);
        $quiz->save();

        $quiz = new \App\Models\Quiz([
            'title' => 'Geschiedenis Quiz',
            'content' => 'Test je kennis over geschiedenis',
        ]);
        $quiz->save();
    }
}
