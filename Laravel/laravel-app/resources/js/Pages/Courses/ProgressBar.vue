<template>
    <div>
        <div class="bg-gray-200 w-full rounded">
            <div v-if="percentage < 80" class=" bg-yellow-300 text-white rounded-l text-center transition-width duration-500" :style="'width:' + percentage + '%'">
                {{ percentage }}%
            </div>
             <div v-else class="bg-green-500 text-white rounded-l text-center transition-width duration-500" :style="'width:' + percentage + '%'">
                {{ percentage }}%
            </div>
        </div>
    </div>
</template>

<script>


export default {
    props: ['watchedVideos', 'videos'],

    data() {
        return {
            state: this.watchedVideos
        }
    },

    computed: {
        percentage(){
            let filterVideos = this.videos.filter(video => { 
                return this.watchedVideos.find(watchedVd => {
                    return watchedVd.id === video.id;
                });

            });
            return Math.ceil(filterVideos.length / this.videos.length * 100) ;
        },

    },

    mounted(){
    }
}
</script>