<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHaunt extends Model
{
    protected $fillable = [
        'user_id',
        'haunted_id'
    ];
    
    protected $table = 'user_haunt';
}

