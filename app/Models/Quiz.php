<?php
namespace App\Models;
use illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['title', 'content'];

    //All quizzes opvragen
    public function getQuizzes($session)
    {
        if(!$session->has('quizzes')) 
        {
            $this->createDummieQuizzes($session);
        }
        return $session->get('quizzes');
    }

    //1 quiz opvragen
    public function getQuiz($session, $id)
    {
        if(!$session->has('quizzes')) 
        {
            $this->createDummieQuizzes();
        }
        return $session->get('quizzes')[$id];
    }

    //Quiz aanmaken
    public function createQuiz($session, $title, $description, $content)
    {
        if(!$session->has('quizzes')) 
        {
            $this->createDummieQuizzes();
        }
        $quizzes = $session->get('quizzes');
        array_push($quizzes, ['title' => $title, 'description' => $description, 'content' => $content]);
        $session->put('quizzes', $quizzes);
    }

    //Quiz updaten
    public function updateQuiz($session, $id, $title, $description, $content)
    {
        $quizzes = $session->get('quizzes');
        $quizzes[$id] = ['title' => $title, 'description' => $description, 'content' => $content];
        $session->put('quizzes', $quizzes);
    }


    //dummy data
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