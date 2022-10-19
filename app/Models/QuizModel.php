<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizModel extends Model
{
    protected $table = 'quiz';


    protected $fillable = [
        'id_category',
        'id_question',
        'id_answer',
        'id_advice'
    ];

}
