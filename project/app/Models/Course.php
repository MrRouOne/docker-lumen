<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $guarded = array('id');

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }
}
