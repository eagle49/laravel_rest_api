<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    //
    protected $table = 'folder';

    protected $fillable = [
        'name',
    ];
}
