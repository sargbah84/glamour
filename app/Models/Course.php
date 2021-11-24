<?php

namespace App\Models;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Course extends Model
{
    use HasFactory, HasTags;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getRouteKey()
    {
        return $this->slug;
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Module::class);
    }

    public function hasWatched($user)
    {
        return $this->whereHas('lessons')->exists();
    }

    public function path()
    {
        return "/courses/{$this->slug}";
    }

    public function detachTags()
    {
        return $this->detachTags($this->typeNames('tags'), 'tags');
    }

    public function syncTagsNames($string)
    {

        $tagArr = explode(',', $string);
        $tags = array_filter($tagArr, function($value) { return !is_null($value) && $value !== ''; });
        return $this->syncTagsWithType($tags, 'tags'); 

    }

    public function tagNames()
    {
        $tags = '';
        $tagArr = $this->tagsWithType('tags');
        foreach($tagArr as $tag){
            $tags .= $tag->name .',';
        }
        return substr($tags, 0, -1);
    }

    public function preview()
    {
        return $this->lessons->count() ? $this->lessons->first()->video_image() : 'https://via.placeholder.com/640x360';
    }

}
