<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassQuizModel extends Model
{
    protected $table = 'pass_quiz';

    protected $fillable = [
        'id_quiz',
        'id_user'
    ];

    protected $primaryKey = 'id_pass_quiz';
    public $timestamps = false;
}
