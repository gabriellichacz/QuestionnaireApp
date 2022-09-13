<?php namespace App\Http\Controllers;

use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use App\Models\Poll;
use App\Models\Answer;

class AdminHomeController extends Controller
{
    public function __construct() { }

    /**
     * Admin dashboard view
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        $polls_array = Poll::select('id', 'title', 'URLslug')->get()->toArray();

        // There's if statement in home.blade so this is not really necessary
        if(!$polls_array) // if there's no polls in database
        {
            return view('/admin.home',[
                'polls_array' => 0,
            ]);
        }
        else //  if there are polls in database
        {
            return view('/admin.home',[
                'polls_array' => $polls_array,
            ]);
        }
    }

    /**
     * Last filled polls
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminLastFilled()
    {
        // Last filled polls
        $last_filled_polls = Poll::with('answers')
            -> join('answers', 'polls.id', '=', 'answers.poll_id') -> select('answers.entry_id', 'answers.poll_id', 'answers.created_at', 'polls.title', 'polls.URLslug')
            -> orderBy('answers.created_at', 'desc') -> groupBy('answers.entry_id') -> distinct();

        // There's if statement in home.blade so this is not really necessary
        if(!$last_filled_polls) // If there's no filled polls in database
        {
            return view('/admin.last_filled',[
                'last_filled_polls' => 0,
            ]);
        }
        else // If there are filled polls in database
        {
            return view('/admin.last_filled',[
                'last_filled_polls' => $last_filled_polls -> paginate(10),
            ]);
        }
    }

    /**
     * Poll entry
     *
     * @param \App\Models\Poll $poll
     * @param mixed $created_at timestamp
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewPollEntry(Poll $poll, $created_at)
    {
        $return_array = $this -> questionsAnswersEntry($poll, $created_at);
        $answers = $return_array[0];
        $questions_array = $return_array[1];

        return view('/admin.poll_entry', compact('poll'), [
            'answers' => $answers,
            'questions_array' => $questions_array,
        ]);
    }

    /**
     * To be used in viewPollEntry() and deletePollEntry()
     *
     * @param \App\Models\Poll $poll
     * @param mixed $entry_id
     * @return array answers and question array
     */
    public function questionsAnswersEntry($poll, $entry_id)
    {
        // All questions
        $questions = $poll -> questions() -> orderBy('orderID', 'asc') -> get(); // need it to be an object to get its answers
        $questions_array = $questions -> toArray(); // array for better index flexibility

        // All answers for questions in this specific entry
        foreach ($questions as $i => $question) {
            $answers[$i] = $question -> answers() -> where('entry_id', $entry_id) -> get() -> toArray();
        }

        return array($answers, $questions_array);
    }

    /**
     * Delete poll entry
     *
     * @param \App\Models\Poll $poll
     * @param mixed $entry_id
     * @return \Illuminate\Contracts\Support\Renderable previous
     */
    public function deletePollEntry(Poll $poll, $entry_id)
    {
        Answer::where('entry_id', $entry_id) -> delete();
 
        return redirect()->back();
    }
}