<template>
    <app-layout>
        <template #header>
            {{ course.title}}
        </template>
            <div class="py-4 mx-8 min-h-screen">
               <div class=" text-2xl">{{ this.courseShow.videos[this.currentKey].title}}</div>
               <iframe class=" w-full h-screen " :src="this.courseShow.videos[this.currentKey].video_url" 
                       title="YouTube video player" frameborder="0" 
                       allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                       allowfullscreen>
               </iframe>
                <div class=" text-sm text-gray-600">{{ this.courseShow.videos[this.currentKey].description}}</div>
                <div class="py-6">
                    <progress-bar :watched-videos="watched" :videos="course.videos"/>
                </div>
                <div class="mt-6 bg-white rounded p-3">
                    <ul v-for="(videos, index) in this.courseShow.videos" v-bind:key="videos.id">
                        <li class=" mt-1 mb-1 flex justify-between items-center">  
                            <div>
                                Video-{{ index + 1}}: {{ videos.title}}
                                <button class=" text-gray-500 focus:text-indigo-500 focus:outline-none" @click="switchVideo(index)"> Watch Video</button>- 
                                <span class="text-gray-400 font-mono">  {{convert(duration[index].duration)}} </span>
                            </div>  
                            <progress-button :video-id="videos.id" :watched-videos="watched"/>
                        </li>
                    </ul>
                </div>

            </div>
    </app-layout>
</template>

<script>



import AppLayout from '../../Layouts/AppLayout.vue';
import ProgressBar from './ProgressBar';
import ProgressButton from './ProgressButton';



export default{
    components : {
        AppLayout,
        ProgressBar,
        ProgressButton
    },

    props : ['course', 'watched', 'duration'],

    data(){
        return {
            courseShow: this.course,
            currentKey: 0,
            duration:this.duration
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
        },

        convert($param){

            let hour = (parseInt($param/3600)).toString();
            let min = (parseInt(($param % 3600)/60)).toString()
            if(hour === '0' && min === '0') return '';
            else if(hour === '0') return min+'m';
            else return hour+'h:'+min+'m';
        }
    },

    mounted() {

        //console.log(this.courseList);
    }
}
</script>
