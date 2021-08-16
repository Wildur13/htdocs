<template>
    <app-layout>
        <template #header>
            List of Formation
        </template>
        <div v-for="course in courses" v-bind:key="course.id">
           <div class="py-3">
                <div class="mx-8 bg-white rounded shadow p-4">
                    <div class=" text-sm text-gray-600">Directed by {{ course.user.name}},  <span class="text-gray">posted on {{this.date(course.created_at)[0] }} at {{this.hour(course.created_at)[0]}},  
                            {{ course.participants}} participant<span v-if=" parseInt(course.participants) > 1">s</span>
                        </span>
                        <div class=" text-sm float-right"> updated on {{this.date(course.updated_at)[0] }} at {{this.hour(course.updated_at)[0]}}</div>
                    </div>
                    <div class="flex justify-between">
                        <h1 class=" text-3xl ">{{ course.title}}</h1>
                        <div class=" text-sm"> {{ course.videos_count}} video<span v-if="course.videos_count > 1">s</span></div>
                    </div>
                        <span class="text-gray-400 font-light"> Duration - {{convert(course.total_duration)}} </span>
                    <div class=" text-sm text-gray-600">{{ course.description}}</div>
                   <div class="flex justify-between">
                        <a :href="'/courses/' + course.id" title="Open" class="bg-indigo-500 text-white px-2 py-1 text-sm rounded mt-3 hover:bg-indigo-700 inline-block flex justify-between">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye mx-2" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 
                                            5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 
                                            1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                            </svg>
                        </a>
                        <a :href="'/courses/edit/' + course.id" title="Edit" v-if="this.auth.name === course.user.name" class="bg-gray-500 text-white px-2 py-1 text-sm rounded mt-3 hover:bg-gray-700 inline-block  flex justify-between" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen mx-2" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 
                                                1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 
                                                1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 
                                                3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                            </svg>
                        </a>
                   </div>

                </div>
           </div>   
        </div>
    </app-layout>
</template>

<script>

import AppLayout from '../../Layouts/AppLayout.vue'
import  Link  from '@inertiajs/inertia-vue3';

export default{
    components : {
        AppLayout,
        Link
    },

    props : ['courses', 'authen'],

    data(){
        return {
            courseList: this.courses,
            auth: this.authen
                
        }
    },

    methods: {

        date($date){
            return $date.split('T', 10);
        },

        hour($data){
            return this.date($data)[1].split('.', 8);
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
        console.log(this.courseList);
    }
}
</script>
