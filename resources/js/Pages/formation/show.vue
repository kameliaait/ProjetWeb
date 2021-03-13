<template lang="">
    <app-layout>
        <template #header></template>
        <div class="m-10 ">
            <div class="text-xl font-bold mb-4 ml-10 ">{{maformation.episodes[this.currentKey].title}} </div>
            <div class="flex justify-center ">

                <iframe width="1200" height="480" :src="maformation.episodes[this.currentKey].video_url" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>

            <div class=" text-lg ml-10 mt-4 ">{{maformation.episodes[this.currentKey].description}} </div>
           <progress-bar :toutformation="formation.episodes" :epwatched="watched"/>

            <ul v-for="(episode, index) in maformation.episodes">
                <li class="mt-3 flex justify-between items-center">
                    <div>
                        {{episode.title}} - episode {{index+1}}
                        <button @click="swichepisode(index)"> voir l'episode</button>
                    </div>
                    <toggle-button :episode-id="episode.id" :watched-episodes="watched" />
                </li>

            </ul>

        </div>
    </app-layout>
</template>
<script>
    import AppLayout from '@/Layouts/AppLayout'
    import ToggleButton from './toggleButton'
    import ProgressBar from './ProgressBar'
    export default {
        data() {
            return {
                maformation: this.formation,
                currentKey: 0,
        
            }
        },
        methods: {
            swichepisode(index) {
                this.currentKey = index;
                window.scrollTo({
                    top: 0,
                    left: 0,
                    behavior: 'smooth'
                });
            },
    
        },
        components: {
            AppLayout,
            ToggleButton,
            ProgressBar
        },
        props: ['formation', 'watched'],
        mounted() {
            console.log(this.watched);
        },
    }
</script>
<style lang="">

</style>