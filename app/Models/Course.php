<?php

namespace App\Models;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

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
}
