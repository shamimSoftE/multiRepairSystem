<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProblemSetup extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'problem_setups';
    protected $fillable = ['problem_name','status'];
}
