<template lang="">
  <app-layout>
    <template #header></template>
    <div class="bg-green-200 text-green-500 p-3" v-if="$page.flash.success">{{$page.flash.success}}</div>
    <div v-for='formation in this.formationlist.data' v-bind:key='formation.id'
      class=" p-4 m-5 bg-white rounded overflow-hidden shadow-md relative my-6  hover:shadow-lg">

      <div class="flex justify-end">
        <span class=" text-purple-500 italic  text-xs m-2 p-2 inline-block ">
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
          class=" text-green-500 text-xs font-bold rounded-full px-2 py-1 cursor-pointer tracking-wider  text- mr-2 border-green-500 md:border-2  hover:bg-green-500 hover:text-white transition ease-out duration-500">Acceder</a>
        <a :href="'formations/edit/' + formation.id" v-if="formation.permition"
          class=" text-yellow-500 text-xs font-bold rounded-full px-2 py-1 cursor-pointer tracking-wider  text- mr-2 border-yellow-500 md:border-2  hover:bg-yellow-500 hover:text-white transition ease-out duration-500">Editer</a>
        <button @click="deleteFormation(formation.id)" v-if="formation.permition"
          class=" text-red-500 text-xs font-bold rounded-full px-2 py-1 cursor-pointer tracking-wider  text- mr-2 border-red-500 md:border-2  hover:bg-red-500 hover:text-white transition ease-out duration-500">Supprimer</button>

      </div>

    </div>
    <div class="flex justify-center">
      <inertia-link v-for="link in formationlist.links"
        v-if="link.label!='&laquo; Previous'&& link.label!='Next &raquo;'" class="text-indigo-700 border-gray-500 p-5 "
        :href="link.url" v-bind:key="link.label">
        <span v-bind:class="{'text-red-700' : link.active}">
          {{link.label}}
        </span>
      </inertia-link>
    </div>
  </app-layout>
</template>
<script>
  import AppLayout from '@/Layouts/AppLayout'
  export default {
    data() {
      return {
        formationlist: this.formation,
      }
    },
    methods: {
      deleteFormation(id) {
        this.$inertia.delete('/formations/delete/' + id);
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