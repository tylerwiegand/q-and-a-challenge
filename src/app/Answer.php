<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'question_id', 'answer', 'tags',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function getTagsAttribute()
    {
        return array_map('trim', explode(',', $this->attributes['tags']));
    }
}
