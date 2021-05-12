<template lang="">
    <div>
    <div class="w-full">
  <div class="shadow w-full bg-grey-light">

    <div class=" bg-indigo-700 text-xs leading-none py-1 text-center transition-width duration-500 text-white" :style="'width:' + pourcentage + '%'"  >{{pourcentage}} %</div>
  </div>
  </div>
  
    </div>
</template>
<script>
export default {
    props:['toutformation','epwatched'],
    data() {
        return {
            watched: this.epwatched,
        }
    },

    computed:{
       pourcentage(){
            let filteredepisodes = this.toutformation.filter(episodes =>{
                return this.watched.find(watchedep =>{
                    return watchedep.id === episodes.id;
                });
            
        });
        return Math.ceil(filteredepisodes.length / this.toutformation.length * 100);
       }
    },
    mounted() {
        eventBus.$on('toggleCompletion', data=>this.watched= data);
       // console.log(this.toutformation, this.epwatched)
    },

}
</script>
<style lang="">
    
</style>