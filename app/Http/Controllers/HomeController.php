<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use App\Models\Poll;
use App\Models\Answer;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() { }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * List of polls
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pollList()
    {
        $polls_array = Poll::select('id', 'title', 'visible', 'URLslug') -> where('visible', 1);

        // There's if statement in poll_list.blade so this is not really necessary
        if(!$polls_array) // if there's no polls in database
        {
            return view('/poll_list',[
                'polls_array' => 0,
            ]);
        }
        else //  if there are polls in database
        {
            return view('/poll_list',[
                'polls_array' => $polls_array -> paginate(10), // pagination
            ]);
        }
    }

    /**
     * Viewing a poll
     *
     * @param \App\Models\Poll $poll
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewPoll(Poll $poll)
    {
        $question_array = $poll -> questions() -> orderBy('orderID', 'asc') -> get() -> toArray();

        return view('view_poll', compact('poll'), [
            'question_array' => $question_array, 
        ]);
    }

    /**
     * Storing poll answers
     *
     * @param \App\Models\Poll $poll
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function storeAnswers(Poll $poll, Request $request)
    {
        // Generating unique id for this specific request
        $request_id = uniqid('ID');

        // Data
        $user_id = Auth::user()->id; // User that filled the poll
        $poll_id = $poll -> id; // Filled poll ID
        $questions = $poll -> questions() -> get() -> toArray();

        // Validation
        $answers = request() -> validate([
            'answer' => ['required', 'array'], // Array itself
            'answer.*' => ['required'], // What the array contains
        ]);

        // Make sure once more
        if(count($answers['answer']) != count($questions)) { // If number of answers isn't equal to number of questions throw an error
            throw ValidationException::withMessages(['answer.*' => 'Wszystkie pola są wymagane']);
        }

        // Making sure every question has an answer (if null then it would save answer as "no answer")
        for ($k = 0; $k < count($questions); $k++) {
            if (empty($answers['answer'][$k])){
                $answers['answer'][$k] = NULL;
            }
        }

        // Separating questions' ids
        foreach ($questions as $key => $item)
        {
            $questions_ids[$key] = $questions[$key]['id'];
        }

        // Saving answers
        foreach ($questions_ids as $key1 => $item1)
        {
            // Changing 0/1 to text
            if ($answers['answer'][$key1] == 0 || $answers['answer'][$key1] == NULL) {
                //$answers['answer'][$key1] = 'Brak odpowiedzi';
            }
            else if ($answers['answer'][$key1] == 1) {
                $answers['answer'][$key1] = 'Nie';
            }
            else if ($answers['answer'][$key1] == 2) {
                $answers['answer'][$key1] = 'Tak';
            }
            else {
                $answers['answer'][$key1] = $answers['answer'][$key1];
            }

            // Creating entity
            Answer::create([
                'poll_id' => $poll_id,
                'entry_id' => $request_id,
                'question_id'=> $questions_ids[$key1],
                'user_id'=> $user_id,
                'answer'=> $answers['answer'][$key1],
            ]);
        }

        return redirect('/poll-list');
    }
}