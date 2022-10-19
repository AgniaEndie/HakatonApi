<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdviceModel extends Model
{
    protected $table = 'advice';

    protected $fillable = [
      'advice_text'
    ];
}
