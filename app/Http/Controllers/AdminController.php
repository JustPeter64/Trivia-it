<?php
namespace App\Http\Controllers;

use App\Models\Quiz;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;

class AdminController extends Controller
{
    //All quizzes opvragen
    public function getIndex()
    {
        $quizzes = Quiz::all();
        return view('quizzen.index', ['quizzes' => $quizzes]);
    }

    //alle quizzes opvragen op admin pagina
    public function getAdminIndex()
    {
        $quizzes = Quiz::all();
        return view('admin.index', ['quizzes' => $quizzes]);
    }

    //1 quiz opvragen
    public function getQuiz(Store $session, $id)
    {
        $quiz = Quiz::find($id);
        return view('quizzen.quiz', ['quiz' => $quiz]);

    }

    //1 quiz opvragen op admin pagina om te maken
    public function getAdminCreate()
    {
        return view('admin.create');
    }

    //1 quiz opvragen op admin pagina om te editen  
    public function getAdminUpdate($id)
    {
        $quiz = Quiz::find($id);
        return view('admin.edit', ['quiz' => $quiz, 'quizId' => $id]);
    }

    //Admin create post opdracht afhandelen
    public function postAdminCreate(Request $request)
    {
        $this->validate($request, [ 
            'title' => 'required|min:5'
        ]);
        $quiz = new Quiz([
            'title' => $request->input('title'), 
            'content' => $request->input('content')
        ]);
        $quiz->save();

        return redirect()->route('admin.index')->with('info', 'Quiz created: ' . $request->input('title'));
    }

    //Admin update post opdracht afhandelen
    public function postAdminUpdate(Store $session, Request $request)
    {
        $this->validate($request, [ 
            'title' => 'required|min:5'
        ]);
        $quiz = Quiz::find($request->input('id'));
        $quiz->title = $request->input('title');
        $quiz->content = $request->input('content');
        $quiz->save();
        
        return redirect()->route('admin.index')->with('info', 'Quiz updated: ' . $request->input('title'));
    } 

    public function getAdminDelete($id)
    {
        $quiz = Quiz::find($id);
        $quiz->delete();
        return redirect()->route('admin.index')->with('info', 'Quiz deleted!');
    }
}
