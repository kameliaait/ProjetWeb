<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajouter une formation
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- component -->
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col" @submit.prevent="submit">
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="title">
                            Titre de la formation

                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                            id="title" type="text" v-model="form.title">
                        <div class=" my-2 bg-red-200 text-red-800 p-4" v-if="$page.errors.title">
                            {{$page.errors.title[0]}}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="description">
                            Description de la formation
                        </label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                            id="description" type="text" v-model="form.description"> </textarea>
                        <div class=" my-2 bg-red-200 text-red-800 p-4" v-if="$page.errors.description">
                            {{$page.errors.description[0]}}</div>

                    </div>

                    <div class="mb-4">
                        <h3 class="text-2xl">Episodes de la formation</h3>
                        <div v-for="(episode,index) in form.episodes" v-bind:key="index">

                            <label class="block text-grey-darker text-sm font-bold mb-2" :for="'title-'+index">
                                Titre de l'episode numero: {{index +1 }}
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                :id="'title-'+index" type="text" v-model="form.episodes[index].title">

                            <div class=" my-2 bg-red-200 text-red-800 p-4"
                                v-if="$page.errors['episodes.'+index+'.title']">
                                {{ $page.errors['episodes.'+index+'.title'][0]}}</div>

                            <label class="block text-grey-darker text-sm font-bold mb-2" :for="'description-'+index">
                                Description de l'episode numero: {{index +1 }}
                            </label>
                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                :id="'description-'+index" type="text" v-model="form.episodes[index].description">
                             </textarea>
                            <div class=" my-2 bg-red-200 text-red-800 p-4"
                                v-if="$page.errors['episodes.'+index+'.description']">
                                {{ $page.errors['episodes.'+index+'.description'][0]}}</div>
                            <label class="block text-grey-darker text-sm font-bold mb-2" :for="'video_url-'+index">
                                URL de la video de l'episode numero: {{index +1 }}
                            </label>
                            <input
                                class=" border-b my-8 shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                :id="'video_url-'+index" type="text" v-model="form.episodes[index].video_url">
                            <div class=" my-2 bg-red-200 text-red-800 p-4"
                                v-if="$page.errors['episodes.'+index+'.video_url']">
                                {{ $page.errors['episodes.'+index+'.video_url'][0]}}</div>
                            <div class="border-b my-5"></div>
                        </div>
                    </div>
                    <div class="inline-flex mb-5">
                        <button class="bg-green-300 hover:bg-green-400 text-gray-800 font-bold py-2 px-4 rounded-l"
                            v-if="form.episodes.length<15" @click.prevent="add">
                            Ajouter ep
                        </button>
                        <button class="bg-red-300 hover:bg-red-400 text-gray-800 font-bold py-2 px-4 rounded-r"
                            v-if="form.episodes.length>1" @click.prevent="remove">
                            Supprimer ep
                        </button>
                    </div>

                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-auto rounded"
                        type="submit">
                        Créer Ma formation
                    </button>

                </form>
                <!--component -->
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    export default {
        components: {
            AppLayout,
        },
        data() {
            return {
                form: {
                    title: null,
                    description: null,
                    episodes: [{
                        title: null,
                        description: null,
                        video_url: null
                    }],
                },
            }
        },
        methods: {
            submit() {
                this.$inertia.post('/formations', this.form)
            },
            add() {
                this.form.episodes.push({
                    title: null,
                    description: null,
                    video_url: null
                });
            },
            remove() {
                this.form.episodes.pop();
            },
        },
    }
</script>