<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $table = 'projects';

    protected $fillable = [
        'title', 'folder_id', 'description', 'type', 'assigner', 'budget'
    ];
}
