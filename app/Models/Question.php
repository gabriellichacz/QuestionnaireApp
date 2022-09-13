<?php namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
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
    protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'poll_id',
        'orderID',
        'question',
        'answer_type',
    ];

    /**
     * Relation - Question belongs to Poll
     * @return app\Models\Poll
     */
    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    /**
     * Relation - Question has many Answers
     * @return app\Models\Answer
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
