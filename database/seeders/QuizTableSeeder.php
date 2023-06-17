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

        $quiz = new \App\Models\Quiz([
            'title' => 'Geografie Quiz',
            'content' => 'Test je kennis over geografie',
        ]);
        $quiz->save();

        $quiz = new \App\Models\Quiz([
            'title' => 'Sport Quiz',
            'content' => 'Test je kennis over sport',
        ]);
        $quiz->save();

        $quiz = new \App\Models\Quiz([
            'title' => 'Wetenschap Quiz',
            'content' => 'Test je kennis over wetenschap',
        ]);
        $quiz->save();

        $quiz = new \App\Models\Quiz([
            'title' => 'Technologie Quiz',
            'content' => 'Test je kennis over technologie',
        ]);
        $quiz->save();
        
    }
}
