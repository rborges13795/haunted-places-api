<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Haunt extends Model
{
    public $timestamps = false;
    protected $table = 'haunts';
    protected $perPage = 10;
    
    protected $fillable = [
        'country',
        'state',
        'city',
        'location',
        'description'
    ];
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_haunt', 'haunted_id', 'user_id');
    }
}
