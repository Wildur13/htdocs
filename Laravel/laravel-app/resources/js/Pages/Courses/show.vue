<template>
    <app-layout>
        <template #header>
            {{ course.title}}
        </template>
           <div class="py-4 mx-8">
               <div class=" text-2xl">{{ course.videos[this.currentKey].title}}</div>
               <iframe class=" w-full h-screen" :src="course.videos[this.currentKey].video_url" 
                       title="YouTube video player" frameborder="0" 
                       allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                       allowfullscreen>
               </iframe>
                <div class=" text-sm text-gray-600">{{ course.videos[this.currentKey].description}}</div>
                <div class="mt-6 bg-white rounded p-3">
                    <ul v-for="(videos, index) in this.course.videos" v-bind:key="videos.id">
                        <li class=" mt-1 mb-1 flex justify-between items-center">  
                            <div>
                                Video-{{ index + 1}}: {{ videos.title}}
                                <button class=" text-gray-500 focus:text-indigo-500 focus:outline-none" @click="switchVideo(index)"> Watch Video</button>  
                            </div>  
                            <progress-button :video-id="videos.id" :watched-videos="watched"/>
                        </li>
                    </ul>
                </div>

            </div>
    </app-layout>
</template>

<script>

import AppLayout from './../../Layouts/AppLayout.vue';
import ProgressButton from './progressButton.vue';

export default{
    components : {
        AppLayout,
        ProgressButton, 
    },

    props : ['course', 'watched'],

    data(){
        return {
            courseShow: this.course,
            currentKey: 0,
        }
    },

    methods:{
        switchVideo(index){
            this.currentKey = index;

            window.scrollTo({
                top:0,
                left:0,
                behavior: 'smooth'
            })
        }
    },

    mounted() {
        //console.log(this.courseList);
    }
}
</script>
