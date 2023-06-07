<?php
namespace App\Models;

class Quiz
{
    public function getQuizzes($session)
    {
        if(!$session->has('quizzes')) 
        {
            $this->createDummieQuizzes($session);
        }
        return $session->get('quizzes');
    }

    private function createDummieQuizzes($session)
    {
        $quizzes = [
            1 => [
                'title' => 'Quiz 1',
                'description' => 'This is a quiz about Laravel',
                'content' => 'This is a quiz about Laravel and it is awesome and you should take it right now'
            ],
            2 => [
                'title' => 'Quiz about something else',
                'description' => 'This is a quiz about something else',
                'content' => 'This is a quiz about something else and it is awesome and you should take it right now'
            ]
        ];
        $session->put('quizzes', $quizzes);
    }
}