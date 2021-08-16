<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Video;
use App\Youtube\YoutubeServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use SebastianBergmann\Environment\Console;

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
        ))->addSelect(DB::raw('(
            SELECT SUM(duration)
                FROM videos
                WHERE videos.course_id = courses.id
        ) AS total_duration'))
        ->withCount('videos')->latest()->get();
        $user = auth()->user();

        return Inertia :: render('Courses/Index', [
            'courses' => $courses,
            'authen' => $user
        ]);
    }

    public function show(int $id){
            
        $course = Course::where('id',$id)->with('videos')->first();
        $duration = Video::select('duration')->where('videos.course_id', $id)->get();
        $watched = auth()->user()->videos;

        return Inertia::render('Courses/Show', [
            'course' => $course,
            'watched' => $watched,
            'duration' => $duration
        ]);
    }

    public function toggleProgress(Request $request) {
        $id =  $request->input('videoId');
        $user = auth()->user();

        $user->videos()->toggle($id);
        return $user->videos;
    }

    public function store(Request $request) {

        $ytb = new YoutubeServices(env('YOUTUBE_API_KEY'));

        $request -> validate([
            'videos' => ['required', 'array'],
            'videos.*.title' => 'required',
            'videos.*.description' => 'required',
            'videos.*.video_url' => 'required',
        ]);

        $course = Course::create($request->all());

        foreach($request -> input('videos') as $video){

            $video['course_id'] = $course->id;
            $video['duration'] = $ytb->handleYoutubeVideoDuration($video['video_url']);

            Video::create($video);
        };

        return Redirect::route('dashboard')->with('message', 'Congratulations, your formation is online yet');
    }

    public function update(Request $request){

        $course = Course::where('id', $request->id)->with('videos')->first();

       

        
        $course->update($request->all());

        $course->videos()->delete();

        foreach($request->videos as $video){
            $video['course_id'] = $course->id;
            Video::create($video);
        }

        return Redirect::route('courses.index');
    }

    public function edit(int $id){
        
        $course = Course::where('id',$id)->with('videos')->first();

        return Inertia::render('Courses/Edit', [
            'course' => $course,
        ]);
    }

}
