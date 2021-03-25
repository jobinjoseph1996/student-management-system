<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkEntry extends Model
{
    use HasFactory;
    protected $table = 'mark_entries';
    protected $fillable = ['student_id', 'terms','maths', 'science', 'history'];

    public function student()
    {
      return $this->hasOne('App\Models\StudentData','id','student_id');
    }
}
