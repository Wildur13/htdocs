<template>
    <app-layout>
        <template #header>
            List of Formation
        </template>
        <div v-for="course in this.courseList" v-bind:key="course.id">
            <div class="card m-b-4">{{ course.title}}
                    <div>{{ course.description}}</div>
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
    data(){
        return {
            courseList: this.courses,
        }
    },

    props : ['courses'],

    mounted() {
        console.log(this.courseList);
    }
}
</script>
