<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $guarded = array('id');
}
