<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    
    protected $fillable = [
        'user_id',
        'task',
        'completed_at'
    ];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'completed_at',
    ];
    
    protected $casts = [
        'user_id' => 'int',
    ];

    public function isCompleted()
    {
        return !is_null($this->completed_at);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
