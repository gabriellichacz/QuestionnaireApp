<?php namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
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
    protected $table = 'polls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'URLslug',
        'visible',
    ];

    /**
     * Relation - Poll has many Questions
     * @return app\Models\Question
     */
    public function questions()
    {
        return $this -> hasMany(Question::class);
    }

    /**
     * Relation - Poll has many Answers
     * @return app\Models\Answer
     */
    public function answers()
    {
        return $this -> hasMany(Answer::class);
    }
}
