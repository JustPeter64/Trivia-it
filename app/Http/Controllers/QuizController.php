<?php
namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Like;
use App\Models\Tag;

use Auth;
use Gate;

use Illuminate\Http\Request;
use App\Http\Requests;

class QuizController extends Controller
{
    //All quizzes opvragen
    public function getIndex()
    {
        $quizzes = Quiz::orderBy('created_at', 'desc')->paginate(3);
        return view('quizzen.index', ['quizzes' => $quizzes]);
    }

    //alle quizzes opvragen op admin pagina
    public function getAdminIndex()
    {
        if(!Auth::check()) {
            return redirect()->back();
        }
        $quizzes = Quiz::orderBy('title', 'asc')->get();
        return view('admin.index', ['quizzes' => $quizzes]);
    }

    //1 quiz opvragen
    public function getQuiz($id)
    {
        $quiz = Quiz::where('id', $id)->with('likes')->first();
        return view('quizzen.quiz', ['quiz' => $quiz]);

    }

    //1 quiz liken
    public function getLikeQuiz($id)
    {
        $quiz = Quiz::where('id', $id)->first();
        $like = new Like();
        $quiz->likes()->save($like);
        return redirect()->back();

    }

    //1 quiz opvragen op admin pagina om te maken
    public function getAdminCreate()
    {
        if(!Auth::check()) {
            return redirect()->back();
        }
        $tags = Tag::all();
        return view('admin.create', ['tags' => $tags]);
    }

    //1 quiz opvragen op admin pagina om te editen  
    public function getAdminUpdate($id)
    {
        if(!Auth::check()) {
            return redirect()->back();
        }
        $quiz = Quiz::find($id);
        $tags = Tag::all();
        return view('admin.edit', ['quiz' => $quiz, 'quizId' => $id, 'tags' => $tags]);
    }

    //Admin create post opdracht afhandelen
    public function postAdminCreate(Request $request)
    {
        if(!Auth::check()) {
            return redirect()->back();
        }
        $this->validate($request, [ 
            'title' => 'required|min:5'
        ]);
        //kijken of de user ingelogd is en anders terugsturen
        $user = Auth::user();
        if (!$user) {
            return redirect()->back();
        }
        $quiz = new Quiz([
            'title' => $request->input('title'), 
            'content' => $request->input('content')
        ]);
        $user->quizzes()->save($quiz);
        $quiz->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));

        return redirect()->route('admin.index')->with('info', 'Quiz created: ' . $request->input('title'));
    }

    //Admin update post opdracht afhandelen
    public function postAdminUpdate(Request $request)
    {
        if(!Auth::check()) {
            return redirect()->back();
        }
        $this->validate($request, [ 
            'title' => 'required|min:5'
        ]);
        $quiz = Quiz::find($request->input('id'));
        if (Gate::denies('manipulate-quiz', $quiz)) {
            return redirect()->back()->with('error', 'This quiz is not yours!');
        }
        $quiz->title = $request->input('title');
        $quiz->content = $request->input('content');
        $quiz->save();
        $quiz->tags()->sync($request->input('tags') === null ? [] : $request->input('tags'));

        return redirect()->route('admin.index')->with('info', 'Quiz updated: ' . $request->input('title'));
    } 

    public function getAdminDelete($id)
    {
        if(!Auth::check()) {
            return redirect()->back();
        }
        $quiz = Quiz::find($id);
        if (Gate::denies('manipulate-quiz', $quiz)) {
            return redirect()->back()->with('info', 'This quiz is not yours!');
        }
        $quiz->likes()->delete();
        $quiz->tags()->detach();
        $quiz->delete();
        return redirect()->route('admin.index')->with('info', 'Quiz deleted!');
    }
}
