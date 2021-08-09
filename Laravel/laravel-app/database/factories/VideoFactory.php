<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this -> faker ->sentence(),
            'description' => $this-> faker ->paragraph(3, true),
            'video_url' => 'mavideo.com' . rand(10, 255),
            'course_id' => Course::all()-> random()->id
        ];
    }
}
