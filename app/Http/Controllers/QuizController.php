<?php
namespace App\Http\Controllers;

use App\Models\Quiz;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;

class QuizController extends Controller
{
    public function getIndex(Store $session)
    {
        $quiz = new Quiz();
        $quizzes = $quiz->getQuizzes($session);
        // $quizzes = $quiz->getQuizzes(session($session));
        return view('quizzen.index', ['quizzes' => $quizzes]);
    }
}
