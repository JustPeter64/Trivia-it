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
        $question4 = new Question([
            'question' => $request->input('question4')
        ]);
        $question5 = new Question([
            'question' => $request->input('question5')
        ]);
        $question6 = new Question([
            'question' => $request->input('question6')
        ]);
        $question7 = new Question([
            'question' => $request->input('question7')
        ]);
        $question8 = new Question([
            'question' => $request->input('question8')
        ]);
        $question9 = new Question([
            'question' => $request->input('question9')
        ]);
        $question10 = new Question([
            'question' => $request->input('question10')
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

        $answer41 = new Answer([
            'answer' => $request->input('answer41'),
            'correct' => $request->input('correct41'),
            'question_id' => $question4->id
        ]);
        $answer42 = new Answer([
            'answer' => $request->input('answer42'),
            'correct' => $request->input('correct42'),
            'question_id' => $question4->id
        ]);
        $answer43 = new Answer([
            'answer' => $request->input('answer43'),
            'correct' => $request->input('correct43'),
            'question_id' => $question4->id
        ]);
        $answer44 = new Answer([
            'answer' => $request->input('answer44'),
            'correct' => $request->input('correct44'),
            'question_id' => $question4->id
        ]);

        $answer51 = new Answer([
            'answer' => $request->input('answer51'),
            'correct' => $request->input('correct51'),
            'question_id' => $question5->id
        ]);
        $answer52 = new Answer([
            'answer' => $request->input('answer52'),
            'correct' => $request->input('correct52'),
            'question_id' => $question5->id
        ]);
        $answer53 = new Answer([
            'answer' => $request->input('answer53'),
            'correct' => $request->input('correct53'),
            'question_id' => $question5->id
        ]);
        $answer54 = new Answer([
            'answer' => $request->input('answer54'),
            'correct' => $request->input('correct54'),
            'question_id' => $question5->id
        ]);

        $answer61 = new Answer([
            'answer' => $request->input('answer61'),
            'correct' => $request->input('correct61'),
            'question_id' => $question6->id
        ]);
        $answer62 = new Answer([
            'answer' => $request->input('answer62'),
            'correct' => $request->input('correct62'),
            'question_id' => $question6->id
        ]);
        $answer63 = new Answer([
            'answer' => $request->input('answer63'),
            'correct' => $request->input('correct63'),
            'question_id' => $question6->id
        ]);
        $answer64 = new Answer([
            'answer' => $request->input('answer64'),
            'correct' => $request->input('correct64'),
            'question_id' => $question6->id
        ]);

        $answer71 = new Answer([
            'answer' => $request->input('answer71'),
            'correct' => $request->input('correct71'),
            'question_id' => $question7->id
        ]);
        $answer72 = new Answer([
            'answer' => $request->input('answer72'),
            'correct' => $request->input('correct72'),
            'question_id' => $question7->id
        ]);
        $answer73 = new Answer([
            'answer' => $request->input('answer73'),
            'correct' => $request->input('correct73'),
            'question_id' => $question7->id
        ]);
        $answer74 = new Answer([
            'answer' => $request->input('answer74'),
            'correct' => $request->input('correct74'),
            'question_id' => $question7->id
        ]);

        $answer81 = new Answer([
            'answer' => $request->input('answer81'),
            'correct' => $request->input('correct81'),
            'question_id' => $question8->id
        ]);
        $answer82 = new Answer([
            'answer' => $request->input('answer82'),
            'correct' => $request->input('correct82'),
            'question_id' => $question8->id
        ]);
        $answer83 = new Answer([
            'answer' => $request->input('answer83'),
            'correct' => $request->input('correct83'),
            'question_id' => $question8->id
        ]);
        $answer84 = new Answer([
            'answer' => $request->input('answer84'),
            'correct' => $request->input('correct84'),
            'question_id' => $question8->id
        ]);

        $answer91 = new Answer([
            'answer' => $request->input('answer91'),
            'correct' => $request->input('correct91'),
            'question_id' => $question9->id
        ]);
        $answer92 = new Answer([
            'answer' => $request->input('answer92'),
            'correct' => $request->input('correct92'),
            'question_id' => $question9->id
        ]);
        $answer93 = new Answer([
            'answer' => $request->input('answer93'),
            'correct' => $request->input('correct93'),
            'question_id' => $question9->id
        ]);
        $answer94 = new Answer([
            'answer' => $request->input('answer94'),
            'correct' => $request->input('correct94'),
            'question_id' => $question9->id
        ]);

        $answer101 = new Answer([
            'answer' => $request->input('answer101'),
            'correct' => $request->input('correct101'),
            'question_id' => $question10->id
        ]);
        $answer102 = new Answer([
            'answer' => $request->input('answer102'),
            'correct' => $request->input('correct102'),
            'question_id' => $question10->id
        ]);
        $answer103 = new Answer([
            'answer' => $request->input('answer103'),
            'correct' => $request->input('correct103'),
            'question_id' => $question10->id
        ]);
        $answer104 = new Answer([
            'answer' => $request->input('answer104'),
            'correct' => $request->input('correct104'),
            'question_id' => $question10->id
        ]);

    


        $user->quizzes()->save($quiz);

        $quiz->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));

        $quiz->questions()->save($question1);
        $quiz->questions()->save($question2);
        $quiz->questions()->save($question3);
        $quiz->questions()->save($question4);
        $quiz->questions()->save($question5);
        $quiz->questions()->save($question6);
        $quiz->questions()->save($question7);
        $quiz->questions()->save($question8);
        $quiz->questions()->save($question9);
        $quiz->questions()->save($question10);
    
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

        $question4->answers()->save($answer41);
        $question4->answers()->save($answer42);
        $question4->answers()->save($answer43);
        $question4->answers()->save($answer44);

        $question5->answers()->save($answer51);
        $question5->answers()->save($answer52);
        $question5->answers()->save($answer53);
        $question5->answers()->save($answer54);

        $question6->answers()->save($answer61);
        $question6->answers()->save($answer62);
        $question6->answers()->save($answer63);
        $question6->answers()->save($answer64);

        $question7->answers()->save($answer71);
        $question7->answers()->save($answer72);
        $question7->answers()->save($answer73);
        $question7->answers()->save($answer74);

        $question8->answers()->save($answer81);
        $question8->answers()->save($answer82);
        $question8->answers()->save($answer83);
        $question8->answers()->save($answer84);

        $question9->answers()->save($answer91);
        $question9->answers()->save($answer92);
        $question9->answers()->save($answer93);
        $question9->answers()->save($answer94);

        $question10->answers()->save($answer101);
        $question10->answers()->save($answer102);
        $question10->answers()->save($answer103);
        $question10->answers()->save($answer104);

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
