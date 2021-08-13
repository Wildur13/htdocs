<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Modification of <span class=" text-2xl" style="font-weigth: 500">
                    {{ courseData.title}}
                </span>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-green-200 text-green-500 p-3" v-if="verified">
                    Congratulations, your formation was edited
                </div>
                <div class="w-full ">
                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="submit">
                        <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Title of Formation
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" 
                                type="text" v-model="courseData.title" required>
                        </div>
                         <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                            Description of Formation
                        </label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description " 
                                type="text" v-model="courseData.description" required>
                        </textarea>
                        <div class="mb-4">
                             <h2 class="text-2xl">
                                 Videos of Formation
                             </h2>
                             <div v-for="(video, index) in courseData.videos" v-bind:key="index">

                                <label class="block text-gray-700 text-sm font-bold mb-2" :for="'title-' + index ">
                                   Title of video-{{ index + 1}}
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :id="'title-' + index " 
                                        type="text" v-model="this.courseData.videos[index].title" required>

                                 <label class="block text-gray-700 text-sm font-bold mb-2" :for="'description-' + index ">
                                   Description of video-{{ index + 1}}
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :id="'description-' + index " 
                                        type="text" v-model="this.courseData.videos[index].description" required>

                                 <label class="block text-gray-700 text-sm font-bold mb-2" :for="'video_url-' + index ">
                                   Url of Video-{{ index + 1}}
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-5" :id="'video_url-' + index " 
                                        type="text" v-model="this.courseData.videos[index].video_url" required>
                             </div>
                        </div>
                        </div>

                        <div class=" flex ">
                            <button class=" py-2 px-4 bg-white rounded my-2 block text-black border hover:bg-gray-400 hover:text-white" @click.prevent="add">+</button>
                            <button v-if="this.courseData.videos.length > 1" class=" py-2 px-4 rounded my-2 text-black block border bg-white mx-10 hover:bg-gray-400 hover:text-white" @click.prevent="remove">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        </div>

                        <div class="flex">
                            <button class=" bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type= "submit">
                            Edit 
                        </button>
                        <a class=" bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mx-5 hover:cursor-pointer" @click="cancel">
                            Cancel
                        </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue'

    export default {
        components: {
            AppLayout,
        },

        props: ['course'],

        data(){
            return {
                verified:null,
                courseData: this.course,
               
            }
        },

        methods: {
            submit() {
                this.$inertia.patch('/courses/' + this.courseData.id, this.courseData),
                this.verified = true,
                window.scrollTo({
                        top:0,
                        left:0,
                        behavior: 'smooth',
            
                }),

                window.setTimeout(this.cancel, 2000)

            },

            add(){
                this.courseData.videos.push({
                    title: null,
                    description: null,
                    video_url: null
                })
            },

            remove(){
                this.courseData.videos.pop()
            },

            cancel(){
                this.$inertia.get('/courses');
            }
        }

    }
</script>
