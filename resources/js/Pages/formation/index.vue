<template lang="">
  <app-layout>
    <template #header></template>
    <div class=" md:ml-4/5 md:mr-4 p-1">
  <div class="bg-white flex items-center rounded-full shadow-xl">
    <input  v-model="term" @keyup="search" class="rounded-l-full w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none" id="search" type="text" placeholder="Search">
    <div class="p-2">
      <button class="bg-blue-500 text-white rounded-full p-2 hover:bg-blue-400 focus:outline-none w-6 h-6 flex items-center justify-center">
        🔎
      </button>
      </div>
    </div>
  </div>
</div>
    <div class="bg-green-200 text-green-500 p-3" v-if="$page.flash.success">{{$page.flash.success}}</div>
    <div v-for='formation in this.formationlist.data' v-bind:key='formation.id'
      class=" p-4 m-5 bg-white rounded overflow-hidden shadow-md relative my-6  hover:shadow-lg">

      <div class="flex justify-end">
        <span class=" text-gray-500 italic  text-xs m-2 p-2 inline-block ">
          {{formation.episodes_count}} Episodes, <span class="text-red-600 text-xs italic">{{formation.participants}}
            participant</span><span v-if="parseInt(formation.participants) > 1">s</span></span>
      </div>
      <div class="my-3">
        <div class=" font-bold text-lg mb-2  ">{{formation.title}}</div>
        <div>{{formation.description}}</div>
        <span class=" text-gray-500 text-sm ">
          Autheur: {{formation.user.name}}
        </span>
      </div>
      <div class="inline-block">
        <a :href="'formation/' + formation.id" :epnumber="formation.episodes_count"
          class=" text-blue-500 text-xs font-bold rounded-full px-2 py-1 cursor-pointer tracking-wider  text- mr-2 border-blue-500 md:border-2  hover:bg-blue-500 hover:text-white transition ease-out duration-500">Acceder</a>
        <a :href="'formations/edit/' + formation.id" v-if="formation.permition"
          class=" text-yellow-400 text-xs font-bold rounded-full px-2 py-1 cursor-pointer tracking-wider  text- mr-2 border-yellow-400 md:border-2  hover:bg-yellow-400 hover:text-white transition ease-out duration-500">Editer</a>
        <button @click="deleteFormation(formation.id)" v-if="formation.permition"
          class=" text-red-500 text-xs font-bold rounded-full px-2 py-1 cursor-pointer tracking-wider  text- mr-2 border-red-500 md:border-2  hover:bg-red-500 hover:text-white transition ease-out duration-500">Supprimer</button>

      </div>

    </div>
   
    <div class="flex justify-center">
      <inertia-link :href="formationlist.prev_page_url" class=" text-indigo-700 px-2" >Previous  </inertia-link>
      
      <inertia-link :href="formationlist.next_page_url" class=" text-indigo-700 px-2">  Next</inertia-link>
    </div>
  </app-layout>
</template>
<script>
  import AppLayout from '@/Layouts/AppLayout'
  export default {
    data() {
      return {
        term:"",
        formationlist: this.formation,
      }
    },
    methods: {
      deleteFormation(id) {
        this.$inertia.delete('/formations/delete/' + id);
      },
      search(){
        this.$inertia.get('/formation?term='+this.term)
      },
    },
    components: {
      AppLayout,
    },
    props: ['formation'],
  }
</script>
<style lang="">

</style>