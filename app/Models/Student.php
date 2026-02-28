<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable = [
        'matricule',
        'name',
        'post_name',
        'email',
        'phone',
        'birth_date',
        'address',
        'photo',
        'bulletin_file',
        'school_id',
        'guardian_id',
    ];
}
