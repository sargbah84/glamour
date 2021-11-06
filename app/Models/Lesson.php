<?php

namespace App\Models;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
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

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function user()
    {
        return $this->belongsTo(UserLesson::class);
    }

    public function user_lessons()
    {
        return $this->hasMany(UserLesson::class);
    }

    public function watched()
    {
        return $this->user_lessons()->latest()->first()->watched ?? 0;
    }

    public function watchedBy($user)
    {
        return $this->user_lessons()->where('user_id', $user->id)->latest()->first()->watched ?? 0;
    }

    public function duration()
    {
        return $this->duration;
    }

    public function isWatched($user)
    {
        return $this->watchedBy($user) >= $this->duration;
    }

    public function hasWatched($user)
    {
        return $this->user_lessons()->where('user_id', $user->id)->exists();
    }

    public function progress($user)
    {
        return $this->watchedBy($user) / $this->duration * 100;
    }

    public function next()
    {
        return $this->where('duration', '<', $this->watched())->latest()->first();
    }

    public function previous()
    {
        return $this->where('duration', '>', $this->watched())->oldest()->first();
    }

    public function nextUrl()
    {
        return url('/courses/lesson/' . $this->next()->slug);
    }

}
