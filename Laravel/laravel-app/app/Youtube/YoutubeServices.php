<?php

namespace App\Youtube;

use DateInterval;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\Cast\String_;

class YoutubeServices {

    private $key = null;

    public function __construct(String $key)
    {
        $this->key = $key;
    }

    public function handleYoutubeVideoDuration(String $video_url){

        // get id with url
        //preg_match('/embed\/(.+)/', $video_url, $matches);
        $matches = preg_split('/\//', $video_url);

        $splitId = preg_split('/\?/',$matches[4]);
        $id = $splitId[0];

        // Api's call
        $response = Http::get("https://www.googleapis.com/youtube/v3/videos?key={$this->key}&id={$id}&part=contentDetails");

        $decodeResponse = json_decode($response);
        $duration = $decodeResponse->items[0]->contentDetails->duration;
         
        // convert to second
        $timeDuration = new DateInterval($duration);

        return $timeDuration->s + $timeDuration->i*60 + $timeDuration->h * 3600;
        

      

    }
}