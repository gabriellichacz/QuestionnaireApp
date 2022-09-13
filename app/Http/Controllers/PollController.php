<?php namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poll;
use App\Models\Question;
use App\Models\Answer;

class PollController extends Controller
{
    public function __construct() { }

    /**
     * Storing new poll in a database
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function storeNewPoll(Request $request)
    {
        $request_title = request() -> title;

        $request_title = Str::squish($request_title); // Remove undesired white spaces
        $URLslug = Str::slug($request_title, '-'); // Convert to slug with '-'

        // Inserting new poll to polls table
        $poll = Poll::create([
            'title' => $request_title,
            'URLslug' => $URLslug,
        ]);
        $poll -> save();

        return redirect()->back();
    }

    /**
     * Deleting a poll from database
     *
     * @param \App\Models\Poll $poll
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deletePoll(Poll $poll)
    {
        $poll_id = $poll -> id;
        
        // Delete row from Polls, Questions and Answers table
        Poll::where('id', '=', $poll_id) -> delete();
        Question::where('poll_id', '=', $poll_id) -> delete();
        Answer::where('poll_id', '=', $poll_id) -> delete();

        return redirect()->back();
    }

    /**
     * Edit poll view
     *
     * @param \App\Models\Poll $poll
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editPoll(Poll $poll)
    {
        $question_array = $poll -> questions() -> orderBy('orderID', 'asc') -> get() -> toArray();

        // compact returns whole poll model
        return view('admin.edit_poll', compact('poll'), [
            'question_array' => $question_array,
        ]);
    }

    /**
     * Updating Poll model entity (in other words editing a poll)
     *
     * @param \App\Models\Poll $poll
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updatePoll(Poll $poll, Request $request)
    {
        $data = request() -> validate([ // Reading data and valiadtion
            'title' => 'required',
            'URLslug' => 'required',
        ]);

        $poll -> update($data);

        return redirect('poll/'.$poll->URLslug.'/edit');
    }

    /**
     * Changing poll visibility
     *
     * @param \App\Models\Poll $poll
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function visibilityPoll(Poll $poll, Request $request)
    {
        $visibility_change = $request -> visible;

        // Changing visibility
        if ($visibility_change == TRUE) {
            $poll -> update(['visible' => TRUE]);
        }
        else if ($visibility_change == FALSE) {
            $poll -> update(['visible' => '0']);
        }
        else redirect('poll/'.$poll->URLslug.'/edit') -> with('status', "Unknown error");

        return redirect('poll/'.$poll->URLslug.'/edit');
    }

    /**
     * Changing order of questions (Ajax post)
     *
     * @param \Illuminate\Http\Request $request
     * @return null
     */
    public function changeOrder(Request $request)
    {
        $positions = $request -> positions; // Getting data from ajax request

        foreach ($positions as $position) {
            $index = $position[0]; // Current index is saved in positions array at 0
            $newPosition = $position[1]; // New index is saved in positions array at 1

            Question::where('id', $index) -> update(['orderID' => $newPosition]); // Updating in database
        }
    }

    /**
     * Summary view of a poll
     *
     * @param \App\Models\Poll $poll
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function summaryPoll(Poll $poll)
    {
        // All questions
        $questions = $poll -> questions() -> get(); // need it to be an object to get its answers
        $questions_array = $questions -> toArray(); // array for better index flexibility

        // All answers for all questions
        foreach ($questions as $i => $question) {
            $answers[$i] = $question -> answers() -> get() -> toArray();
        }

        // Check if data is in database
        if (!$questions_array) { // if there's no questions in database
            return $this -> summaryReturn($poll, 0, 0, 0, 0, 0);
        }
        else if (!array_values($answers)[0] && $questions_array) { // if there's no answers in database but there are questions
            return $this -> summaryReturn($poll, 0, $questions_array, 0, 0, 0);
        }
        else { // if there are answers and questions in database
            $number_of_answers = count(array_values($answers)[0]); // How many answers to this poll are there

            foreach ($questions_array as $i => $question) { 
                $questions_array_ids[$i] = $question['id']; // Getting real question ids from database
            }
            $questions_array = array_combine($questions_array_ids, $questions_array); // Fixing question_array IDs
            $answers = array_combine($questions_array_ids, $answers); // Fixing answers IDs

            $answers_yes_sum = $this -> summaryYesNo($poll, 'tak'); // Getting number of yes/no answers to a question
            $answers_no_sum = $this -> summaryYesNo($poll, 'nie');

            return $this -> summaryReturn($poll, $answers, $questions_array, $number_of_answers, $answers_yes_sum, $answers_no_sum);
        }
    }

    /**
     * Function used to simplify returns in summaryPoll()
     *
     * @param mixed $answers
     * @param mixed $questions_array
     * @param mixed $number_of_answers
     * @param mixed $answers_yes_sum
     * @param mixed $answers_no_sum
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private function summaryReturn($poll, $answers, $questions_array, $number_of_answers, $answers_yes_sum, $answers_no_sum)
    {
        return view('admin.summary_poll', compact('poll'), [
            'answers' => $answers,
            'questions_array' => $questions_array,
            'number_of_answers' => $number_of_answers,
            'answers_yes_sum' => $answers_yes_sum,
            'answers_no_sum' => $answers_no_sum,
        ]);
    }

    /**
     * Counting how many yes or no answers there were to this type of questions
     *
     * @param mixed $poll
     * @param mixed $yesno
     * @return array
     */
    private function summaryYesNo($poll, $yesno)
    {
        try {
            $questions_yesno = $poll -> questions() -> where('answer_type', 1) -> get(); // Yes/No questions
            foreach ($questions_yesno as $i => $question) 
            {
                $questions_yesno_ids[$i] = $question['id']; // Yes/No questions ids
                $answers_sum[$i] = $question -> answers() -> where('answer', $yesno) -> count();
            }
            return array_combine($questions_yesno_ids, $answers_sum); // Combining ids with number of answers
        } catch (\Throwable $th) {
            return 0;
        }
    }
}