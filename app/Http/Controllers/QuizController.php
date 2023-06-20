<?php
namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Like;
use App\Models\Tag;
use App\Models\Question;
use App\Models\Answer;

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

    ////////////////////////////
    //Admin routes
    ////////////////////////////

    //alle quizzes opvragen op admin pagina
    public function getAdminIndex()
    {
        $quizzes = Quiz::orderBy('title', 'asc')->get();
        return view('admin.index', ['quizzes' => $quizzes]);
    }

    
    //1 quiz opvragen op admin pagina om te maken
    public function getAdminCreate()
    {
        $tags = Tag::all();
        return view('admin.create', ['tags' => $tags]);
    }

    //1 quiz opvragen op admin pagina om te editen  
    public function getAdminUpdate($id)
    {
        $quiz = Quiz::find($id);
        $tags = Tag::all();
        return view('admin.edit', ['quiz' => $quiz, 'quizId' => $id, 'tags' => $tags]);
    }

    //Admin create post opdracht afhandelen
    public function postAdminCreate(Request $request)
    {
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
            'description' => $request->input('description')
        ]);
        $user->quizzes()->save($quiz);
        $quiz->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));

        return redirect()->route('admin.index')->with('info', 'Quiz created: ' . $request->input('title'));
    }

    //Admin update post opdracht afhandelen
    public function postAdminUpdate(Request $request)
    {
        $this->validate($request, [ 
            'title' => 'required|min:5'
        ]);
        $quiz = Quiz::find($request->input('id'));      
        $quiz->title = $request->input('title');
        $quiz->description = $request->input('description');
        $quiz->save();
        $quiz->tags()->sync($request->input('tags') === null ? [] : $request->input('tags'));

        return redirect()->route('admin.index')->with('info', 'Quiz updated: ' . $request->input('title'));
    } 

    public function getAdminDelete($id)
    {
        $quiz = Quiz::find($id);
        $quiz->likes()->delete();
        $quiz->tags()->detach();
        $quiz->delete();
        return redirect()->route('admin.index')->with('info', 'Quiz deleted!');
    }

    ////////////////////////////
    //Creator routes
    ////////////////////////////

    //alle quizzes opvragen op Creator pagina
    public function getCreatorIndex()
    {
        $quizzes = Quiz::orderBy('title', 'asc')->get();
        $questions = Question::all();
        $answers = Answer::all();
        return view('creator.index', ['quizzes' => $quizzes, 'questions' => $questions, 'answers' => $answers]);
    }

    
    //1 quiz opvragen op Creator pagina om te maken
    public function getCreatorCreate()
    {
        $tags = Tag::all();
        return view('creator.create', ['tags' => $tags]);
    }

    //1 quiz opvragen op Creator pagina om te editen  
    public function getCreatorUpdate($id)
    {
        $quiz = Quiz::find($id);
        $tags = Tag::all();
        $questions = Question::where('quiz_id', $id)->get();
        $answers = Answer::where('question_id', $id)->get();
        return view('creator.edit', ['quiz' => $quiz, 'quizId' => $id, 'tags' => $tags, 'questions' => $questions, 'answers' => $answers]);
    }

    //Creator create post opdracht afhandelen
    public function postCreatorCreate(Request $request)
    {
        $this->validate($request, [ 
            'title' => 'required|min:5'
        ]);
        //kijken of de user ingelogd is en anders terugsturen
        $user = Auth::user();
        if (!$user) {
            return redirect()->back();
        }
        $questions = new Question([
            'question' => $request->input('question')
        ]);
        $answer1 = new Answer([
            'answer' => $request->input('answer1'),
            'correct' => $request->input('correct1')
        ]);
        $answer2 = new Answer([
            'answer' => $request->input('answer2'),
            'correct' => $request->input('correct2')
        ]);
        $answer3 = new Answer([
            'answer' => $request->input('answer3'),
            'correct' => $request->input('correct3')
        ]);
        $answer4 = new Answer([
            'answer' => $request->input('answer4'),
            'correct' => $request->input('correct4')
        ]);
        $quiz = new Quiz([
            'title' => $request->input('title'), 
            'description' => $request->input('description'),
        ]);
        $user->quizzes()->save($quiz);
        $quiz->questions()->save($questions);
        $questions->answers()->save($answer1);
        $questions->answers()->save($answer2);
        $questions->answers()->save($answer3);
        $questions->answers()->save($answer4);
        
        $quiz->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));

        return redirect()->route('creator.index')->with('info', 'Quiz created: ' . $request->input('title'));
    }

    //Creator update post opdracht afhandelen
    public function postCreatorUpdate(Request $request)
    {
        $this->validate($request, [ 
            'title' => 'required|min:5'
        ]);
        $quiz = Quiz::find($request->input('id'));
        $questions = Question::where('quiz_id', $request->input('id'));
        $answers = Answer::where('question_id', $request->input('id'));
        if (Gate::denies('manipulate-quiz', $quiz)) {
            return redirect()->back()->with('error', 'This quiz is not yours!');
        }
        $quiz->title = $request->input('title');
        $quiz->description = $request->input('description');
        $quiz->save();
        $quiz->tags()->sync($request->input('tags') === null ? [] : $request->input('tags'));

        $questions->question = $request->input('question');
        $questions->save();

        $answers->answer = $request->input('answer');
        $answers->save();

        return redirect()->route('creator.index')->with('info', 'Quiz updated: ' . $request->input('title'));
    } 

    public function getCreatorDelete($id)
    {
        $quiz = Quiz::find($id);
        $questions = Question::where('quiz_id', $id);
        $answers = Answer::where('question_id', $id);
        if (Gate::denies('manipulate-quiz', $quiz)) {
            return redirect()->back()->with('info', 'This quiz is not yours!');
        }
        $quiz->likes()->delete();
        $quiz->tags()->detach();
        $quiz->delete();
        $questions->delete();
        $answers->delete();
        return redirect()->route('creator.index')->with('info', 'Quiz deleted!');
    }
}
