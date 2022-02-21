<template>
    <in-head title="Créer un nouveau canal de données"/>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Création d'un nouveau canal de données
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="p-6 sm:px-20 bg-white border-b border-gray-200 text-center flex justify-center flex-col">
                        <div class="mt-8 text-2xl">Créer un nouveau canal de données</div>
                        <div class="mt-2 mb-8 text-sm text-gray-500">
                            Ajouter un nouveau canal de données, le titre et la description sont des attributs qui vont vous aider à identifier votre canal,
                            ce canal représentera l'interface <strong>SFP4.0Collector</strong> que vous pouvez installer sur chaque poste de votre système.
                            La variable <code>OPC</code> représente le lien du serveur complet, en format <code>opc.tcp</code>.
                            La variable <code>Synchronisation</code> représente la fréquence de synchronisation de la collecte par votre collecteur.
                        </div>
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle min-w-full sm:px-6 lg:px-8">
                                <form @submit.prevent="submit">
                                    <div class="rounded-md shadow-sm">
                                        <div class="m-2 py-2 flex">
                                            <label for="title" class="text-sm appearance-none rounded-none border-none rounded-l-md px-3 py-2 border border-gray-300 bg-gray-200 text-gray-900">Titre</label>
                                            <input id="title" name="title" v-model="form.title" type="text"
                                                   required=""
                                                   class="appearance-none rounded-none rounded-r-md w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                                   placeholder="Titre"/>
                                        </div>
                                        <div class="m-2 py-2 flex">
                                            <label for="description" class="text-sm appearance-none rounded-none border-none rounded-l-md px-3 py-2 border border-gray-300 bg-gray-200 text-gray-900">Description</label>
                                            <input id="description" name="description" v-model="form.description"
                                                   type="text"
                                                   required=""
                                                   class="appearance-none rounded-none rounded-r-md w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                                   placeholder="Description"/>
                                        </div>
                                        <div class="m-2 py-2 flex">
                                            <label for="opc" class="text-sm appearance-none rounded-none border-none rounded-l-md px-3 py-2 border border-gray-300 bg-gray-200 text-gray-900">OPC-UA Server URL</label>
                                            <input id="opc" name="opc"
                                                   v-model="form.opc" type="text"
                                                   required=""
                                                   class="appearance-none rounded-none rounded-r-md w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                                   placeholder="opc.tcp://127.0.0.1:4840/SimulationServer"/>
                                        </div>
                                        <div class="m-2 py-2 flex">
                                            <label for="clock" class="text-sm appearance-none rounded-none border-none rounded-l-md px-3 py-2 border border-gray-300 bg-gray-200 text-gray-900">Synchronisation</label>
                                            <input id="clock" name="clock"
                                                   v-model="form.clock" type="number"
                                                   required=""
                                                   class="appearance-none rounded-none rounded-r-md w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                                   placeholder="Synchronisation"/>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" :class="{ 'opacity-25': form.processing }"
                                                :disabled="form.processing"
                                                class="mt-4 group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Enregister
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import {defineComponent} from "vue";
import AppLayout from '@/Layouts/AppLayout';
import {Head as InHead, Link as InLink} from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {AppLayout, InHead, InLink},
    name: "Create",
    data() {
        return {
            form: this.$inertia.form({
                title: '',
                description: '',
                opc: "opc.tcp://127.0.0.1:4840/OPC-UA/SimulationServer",
                clock: 1,
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(this.route('channels.store'), {
                onFinish: () => this.form.reset(),
            });
        },
    },
});
</script>

<style scoped>

</style>
