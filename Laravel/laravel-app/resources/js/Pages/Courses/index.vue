<template>
    <app-layout>
        <template #header>
            List of Formation
        </template>
        <div v-for="course in this.courseList" v-bind:key="course.id">
           <div class="py-3">
                <div class="mx-8 bg-white rounded shadow p-4">
                    <div class=" text-sm text-gray-600">Directed by {{ course.user.name}} -   <span class="text-gray">
                            {{ course.participants}} participant<span v-if=" parseInt(course.participants) > 1">s</span>
                        </span>
                    </div>
                    <div class=" flex justify-between items-center">
                        <div class=" text-3xl ">{{ course.title}}</div>
                        <div class=" text-sm"> {{ course.videos_count}} videos</div>
                    </div>
                    <div class=" text-sm text-gray-600">{{ course.description}}</div>
                    <a :href="'/course/' + course.id" class="bg-indigo-500 text-white px-2 py-1 text-sm rounded mt-3 hover:bg-indigo-700 inline-block ">
                        See Formation
                    </a>
                </div>
           </div>

            
        </div>
    </app-layout>
</template>

<script>

import AppLayout from './../../Layouts/AppLayout.vue'

export default{
    components : {
        AppLayout
    },

    props : ['courses'],

    data(){
        return {
            courseList: this.courses,
        }
    },


    mounted() {
        console.log(this.courseList);
    }
}
</script>
