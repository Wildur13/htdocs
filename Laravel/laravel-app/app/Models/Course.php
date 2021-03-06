<?php

namespace App\Models;

use App\Models\Video;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    protected static function booted()
    {
        static::creating(function($course) {
            $course->user_id = auth()->id();
        });
    }
    
    public function videos() {
        return $this->hasMany(Video::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
