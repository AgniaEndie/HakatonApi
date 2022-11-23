<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerModel extends Model
{
    use HasFactory;


    protected $table = 'answer';

    protected $fillable = [
        "id_question",
        "answer"
    ];

    protected $primaryKey = 'id_answer';
    public $timestamps = false;
}
