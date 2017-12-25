<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title_pl', 'title_en', 'description_pl', 'description_en', 'images'
    ];
}
