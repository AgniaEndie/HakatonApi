<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model
{
    protected $table = 'question';

    protected $fillable = [
      'id_category',
      'question'
    ];

    protected $primaryKey = 'id_question';
    public $timestamps = false;
}
