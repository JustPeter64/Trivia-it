<?php
namespace App\Http\Controllers;

use App\Models\Quiz;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;

class QuizController extends Controller
{
    //All quizzes opvragen
    public function getIndex(Store $session)
    {
        $quiz = new Quiz();
        $quizzes = $quiz->getQuizzes($session);
        // $quizzes = $quiz->getQuizzes(session($session));
        return view('quizzen.index', ['quizzes' => $quizzes]);
    }

    //alle quizzes opvragen op admin pagina
    public function getAdminIndex(Store $session)
    {
        $quiz = new Quiz();
        $quizzes = $quiz->getQuizzes($session);
        return view('admin.index', ['quizzes' => $quizzes]);
    }

    //1 quiz opvragen
    public function getQuiz(Store $session, $id)
    {
        $quiz = new Quiz();
        $quiz = $quiz->getQuiz($session, $id);
        return view('quizzen.quiz', ['quiz' => $quiz,]);
    }

    //1 quiz opvragen op admin pagina om te maken
    public function getAdminCreate()
    {
        return view('admin.create');
    }

    //1 quiz opvragen op admin pagina om te editen
    public function getAdminUpdate(Store $session, $id)
    {
        $quiz = new Quiz();
        $quiz = $quiz->getQuiz($session, $id);
        return view('admin.edit', ['quiz' => $quiz, 'quizId' => $id]);
    }

    //Admin create post opdracht afhandelen
    public function postAdminCreate(Store $session, Request $request)
    {
        $this->validate($request, [ 
            'title' => 'required|min:5'
        ]);
        $quiz = new Quiz();
        $quiz->createQuiz($session, $request->input('title'), $request->input('description'), $request->input('content'));
        return redirect()->route('admin.index')->with('info', 'Quiz created: ' . $request->input('title'));
    }

    //Admin update post opdracht afhandelen
    public function postAdminUpdate(Store $session, Request $request)
    {
        $quiz = new Quiz();
        $quiz->updateQuiz($session, $request->input('id'), $request->input('title'), $request->input('description'), $request->input('content'));
        return redirect()->route('admin.index')->with('info', 'Quiz updated: ' . $request->input('title'));
    } 
}
