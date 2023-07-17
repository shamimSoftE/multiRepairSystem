<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected  $table = 'suppliers';
    protected  $fillable = ['name', 'address', 'mobile', 'phone', 'email', 'web', 'contact_person', 'opening_balance'];
}
