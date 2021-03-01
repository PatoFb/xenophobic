<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'Angry',
        'Sad',
        'Fear',
        'Happy',
        'Excited',
        'Bored',
        'score_tag',
        'agreement',
        'subjectivity',
        'confidence',
        'irony'
    ];
}
