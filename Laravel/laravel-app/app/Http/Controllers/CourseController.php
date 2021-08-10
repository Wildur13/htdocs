<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function index(){

        $courses = Course :: with('user')
        ->select('courses.*', DB::raw(
            '(SELECT COUNT(DISTINCT(user_id))
            FROM completions
            INNER JOIN videos ON completions.video_id = videos.id
            WHERE  videos.course_id = courses.id)
            AS participants'
        ))->withCount('videos')->latest()->get();

        return Inertia :: render('Courses/index', [
            'courses' => $courses,
        ]);
    }

    public function show(int $id){
            
        $course = Course::where('id',$id)->with('videos')->first();
        $watched = auth()->user()->videos;

        return Inertia::render('Courses/show', [
            'course' => $course,
        ]);
    }

    public function toggleProgress(Request $request) {
        $id =  $request->input('videoId');
        $user = auth()->user();

        $user->videos()->toggle($id);
        return $user->videos;
    }
}
