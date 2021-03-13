<template lang="">
    <div>
        <button
            class=" text-green-500 text-xs font-bold rounded-full px-2 py-1 cursor-pointer tracking-wider  text- mr-2 border-green-500 md:border-2  hover:bg-green-500 hover:text-white transition ease-out duration-500"
            @click="toggleCompletion()">{{this.iswatched ? 'terminé' : 'terminé?'}}</button>
    </div>
</template>
<script>
    export default {
        props: ['episodeId', 'watchedEpisodes'],
        data() {
            return {
                watchedep: this.watchedEpisodes,
                iswatched: null
            }
        },
        methods: {
            toggleCompletion() {
                axios.post('/completion', {
                        episodeId: this.episodeId,
                    })
                    .then(response => {
                        if(response.status==200){
                        this.iswatched = !this.iswatched;
                        eventBus.$emit('toggleCompletion', response.data);
                        //console.log(this.iswatched);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            iswatchedepisode() {
                return this.watchedep.find(
                    episode => episode.id === this.episodeId) ? true : false;
            },
           
           
        },
           mounted() {
                this.iswatched = this.iswatchedepisode();
            },
        
         
    }
</script>
<style lang="">

</style>