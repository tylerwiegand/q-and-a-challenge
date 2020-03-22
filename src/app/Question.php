<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Question extends Model
{
    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('question')
            ->saveSlugsTo('slug')
            ->usingSeparator('_')
            ->slugsShouldBeNoLongerThan(20);
    }

    public static $sortable = [
        'rank',
    ];

    public static $sortDirections = [
        'DESC', 'ASC',
    ];

    protected $fillable = [
        'question', 'rank',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
