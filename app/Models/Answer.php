<?php namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    /**
     * Allow mass assigments
     */
    protected $guarded = [];

    /**
     * Corresponding table
     *
     * @var string table name
     */
    protected $table = 'answers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'poll_id',
        'entry_id',
        'question_id',
        'user_id',
        'answer',
    ];

    /**
     * Relation - Answer belongs to Question
     * @return app\Models\Question
     */
    public function question()
    {
        return $this -> belongsTo(Question::class);
    }

    /**
     * Relation - Answer belongs to Poll
     * @return app\Models\Poll
     */
    public function poll()
    {
        return $this -> belongsTo(Poll::class);
    }
}
