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

    //1 quiz post opdracht afhandelen
    public function postQuiz(Request $request)
    {
        $this->validate($request, [ 
            'answer' => 'required'
        ]);
        $quiz = Quiz::find($request->input('quiz_id'));
        if (!$quiz) {
            return redirect()->route('quizzen.index')->with('info', 'That quiz does not exist!');
        }
        $answer = Answer::find($request->input('answer'));
        if (!$answer) {
            return redirect()->route('quizzen.quiz', ['id' => $request->input('quiz_id')])->with('info', 'That answer does not exist!');
        }
        $user = Auth::user();
        $user->answers()->attach($request->input('answer'));

        if ($answer->correct) {
            $user->points += 1;
            $user->save();
            return redirect()->route('quizzen.quiz', ['id' => $request->input('quiz_id')])->with('info', 'Correct! You have ' . $user->points . ' points!');
        }

        return redirect()->route('quizzen.quiz', ['id' => $request->input('quiz_id')])->with('info', 'Your answer was submitted!');
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
            'title' => 'required|min:5',

            'question1' => 'required|min:5',
            'question2' => 'required|min:5',
            'question3' => 'required|min:5',

            'answer11' => 'required',
            'answer12' => 'required',
            'answer13' => 'required',
            'answer14' => 'required',
            'answer21' => 'required',
            'answer22' => 'required',
            'answer23' => 'required',
            'answer24' => 'required',
            'answer31' => 'required',
            'answer32' => 'required',
            'answer33' => 'required',
            'answer34' => 'required',
        ]);
        
        //kijken of de user ingelogd is en anders terugsturen
        $user = Auth::user();
        if (!$user) {
            return redirect()->back();
        }

        $quiz = new Quiz([
            'title' => $request->input('title'), 
            'description' => $request->input('description'),
        ]);


        $question1 = new Question([
            'question' => $request->input('question1')
        ]);
        $question2 = new Question([
            'question' => $request->input('question2')
        ]);
        $question3 = new Question([
            'question' => $request->input('question3')
        ]);


        $answer11 = new Answer([
            'answer' => $request->input('answer11'),
            'correct' => $request->input('correct11'),
            'question_id' => $question1->id
        ]);
        $answer12 = new Answer([
            'answer' => $request->input('answer12'),
            'correct' => $request->input('correct12'),
            'question_id' => $question1->id
        ]);
        $answer13 = new Answer([
            'answer' => $request->input('answer13'),
            'correct' => $request->input('correct13'),
            'question_id' => $question1->id
        ]);
        $answer14 = new Answer([
            'answer' => $request->input('answer14'),
            'correct' => $request->input('correct14'),
            'question_id' => $question1->id
        ]);

        $answer21 = new Answer([
            'answer' => $request->input('answer21'),
            'correct' => $request->input('correct21'),
            'question_id' => $question2->id
        ]);
        $answer22 = new Answer([
            'answer' => $request->input('answer22'),
            'correct' => $request->input('correct22'),
            'question_id' => $question2->id
        ]);
        $answer23 = new Answer([
            'answer' => $request->input('answer23'),
            'correct' => $request->input('correct23'),
            'question_id' => $question2->id
        ]);
        $answer24 = new Answer([
            'answer' => $request->input('answer24'),
            'correct' => $request->input('correct24'),
            'question_id' => $question2->id
        ]);

        $answer31 = new Answer([
            'answer' => $request->input('answer31'),
            'correct' => $request->input('correct31'),
            'question_id' => $question3->id
        ]);
        $answer32 = new Answer([
            'answer' => $request->input('answer32'),
            'correct' => $request->input('correct32'),
            'question_id' => $question3->id
        ]);
        $answer33 = new Answer([
            'answer' => $request->input('answer33'),
            'correct' => $request->input('correct33'),
            'question_id' => $question3->id
        ]);
        $answer34 = new Answer([
            'answer' => $request->input('answer34'),
            'correct' => $request->input('correct34'),
            'question_id' => $question3->id
        ]);
   
        $user->quizzes()->save($quiz);

        $quiz->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));

        $quiz->questions()->save($question1);
        $quiz->questions()->save($question2);
        $quiz->questions()->save($question3);
    
        $question1->answers()->save($answer11);
        $question1->answers()->save($answer12);
        $question1->answers()->save($answer13);
        $question1->answers()->save($answer14);

        $question2->answers()->save($answer21);
        $question2->answers()->save($answer22);
        $question2->answers()->save($answer23);
        $question2->answers()->save($answer24);

        $question3->answers()->save($answer31);
        $question3->answers()->save($answer32);
        $question3->answers()->save($answer33);
        $question3->answers()->save($answer34);

        return redirect()->route('creator.index')->with('info', 'Quiz created: ' . $request->input('title'));
    }

    //Creator update post opdracht afhandelen
    public function postCreatorUpdate(Request $request)
    {
        $this->validate($request, [ 
            'title' => 'required|min:5',
        ]);

        $quiz = Quiz::find($request->input('id'));
        $questions = Question::where('quiz_id', $request->input('id'));
        $answers = Answer::where('question_id', $request->input('id'));
   
        if (Gate::denies('manipulate-quiz', $quiz)) {
            return redirect()->back()->with('error', 'This quiz is not yours!');
        }
        $quiz->title = $request->input('title');
        $quiz->description = $request->input('description');

        $questions->save();
        // $questions->save([
        //     'question' => $request->input('question1'),
        //     'question' => $request->input('question2'),
        //     'question' => $request->input('question3')
        // ]);   

        $quiz->save();
        $quiz->tags()->sync($request->input('tags') === null ? [] : $request->input('tags'));
        
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
