<template>
    <div>   
        <button v-if="this.isWatched" class=" rounded p-1 bg-green-500 text-white" @click="toggleProgress()"> 
            Completed
        </button>
        <button v-else class=" rounded p-1 text-white bg-yellow-400" @click="toggleProgress()"> 
            Incompleted
        </button>
    </div>
</template>

<script>
import axios from "axios"


export default ({
    
    props: ['video-id', 'watchedVideos'],

    data(){
        return{
            watchedVd: this.watchedVideos,
            isWatched: null
        }
    },

    methods: {
        toggleProgress(){
            axios.post('/toggleProgress', {videoId: this.videoId,
            })
            .then( response => {
                if(response.status === 200) this.isWatched = !this.isWatched;
            })
            .catch(error =>console.log(error));
        },

        isWatchedVideo(){
            return this.watchedVd.find(video => video.id === this.videoId) ? true : false;
        }
    },

    mounted() {
        this.isWatched = this.isWatchedVideo();
    }
})
</script>
