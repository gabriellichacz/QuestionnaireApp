<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poll;
use App\Models\Question;
use App\Models\Answer;

class QuestionController extends Controller
{
    public function __construct() { }

    /**
     * Storing new question in a database
     *
     * @param \App\Models\Poll $poll
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function storeQuestion(Poll $poll, Request $request)
    {
        // Data validation
        $data = request() -> validate(([
            'question' => 'required', // because of array in create question form
            'answer_type' => 'required', // because it's answer[][answer] in form, * means anything
        ]));

        // Storing data
        $poll -> questions() -> create($data);

        return redirect()->back();
    }

    /**
     * Deleting question from database
     *
     * @param \App\Models\Poll $poll
     * @param \App\Models\Question $question
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteQuestion(Poll $poll, Question $question)
    {
        Question::where('id', '=', $question->id) -> delete();

        return redirect()->back();
    }

    /**
     * Edit question view
     *
     * @param \App\Models\Poll $poll
     * @param \App\Models\Question $question
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editQuestion(Poll $poll, Question $question)
    {
        // compact returns whole question model
        return view('admin.edit_question', compact('question'), compact('poll'));
    }

    /**
     * Updating Question model entity (in other words editing a question)
     *
     * @param \App\Models\Poll $poll
     * @param \App\Models\Question $question
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateQuestion(Poll $poll, Question $question)
    {
        $data = request() -> validate([ // data valiadtion
            'question' => 'required',
            'answer_type' => 'required',
        ]);

        $question -> update($data); // updating model

        return redirect('poll/'.$poll->URLslug.'/edit');
    }
}