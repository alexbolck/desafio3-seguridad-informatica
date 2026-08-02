<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileModel extends Model
{
    protected $table = 'files';
    protected $fillable = ['user_id', 'filename', 'path'];
    public $timestamps = false;
}
