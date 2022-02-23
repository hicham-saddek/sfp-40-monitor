<template>
    <in-head title="Modifier une nouvelle variable"/>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Modification d'une variable
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="p-6 sm:px-20 bg-white border-b border-gray-200 text-center flex justify-center flex-col">
                        <div class="mt-8 text-2xl">Créer une nouvelle variable</div>
                        <div class="mt-2 mb-8 text-sm text-gray-500">
                            Ajouter une variable à monitorer, le titre et la description sont des attributs qui vont
                            vous aider à identifier votre variable, elle représente un capteur ou un actionneur de votre
                            système que vous souhaiter monitorer, 'Node ID' représente votre
                            capteur ou votre actionneur vous pouvez voir de la documentation de la plateforme
                            disponible pour plus de détails.
                        </div>
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <form @submit.prevent="submit">
                                    <div class="rounded-md shadow-sm -space-y-px">
                                        <div class="m-2 py-2 flex">
                                            <label for="title" class="text-sm appearance-none rounded-none border-none rounded-l-md px-3 py-2 border border-gray-300 bg-gray-200 text-gray-900">Titre</label>
                                            <input id="title" name="title" v-model="form.title" type="text"
                                                   required=""
                                                   class="appearance-none rounded-none rounded-r-md w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                                   placeholder="Nom de la variable par exemple"/>
                                        </div>
                                        <div class="m-2 py-2 flex">
                                            <label for="description" class="text-sm appearance-none rounded-none border-none rounded-l-md px-3 py-2 border border-gray-300 bg-gray-200 text-gray-900">Description</label>
                                            <input id="description" name="description" v-model="form.description" type="text"
                                                   required=""
                                                   class="appearance-none rounded-none rounded-r-md w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                                   placeholder="Une petite description significatif"/>
                                        </div>
                                        <div class="m-2 py-2 flex">
                                            <label for="node_id" class="text-sm appearance-none rounded-none border-none rounded-l-md px-3 py-2 border border-gray-300 bg-gray-200 text-gray-900">Node ID</label>
                                            <input id="node_id" name="node_id" v-model="form.node_id" type="text"
                                                   required=""
                                                   class="appearance-none rounded-none rounded-r-md w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                                   placeholder="Node ID (ns=;s=)"/>
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
    name: "Edit",
    props: {
        variable: Object,
        channel: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                title: this.variable.title,
                description: this.variable.description,
                node_id: this.variable.node_id,
            }),
        };
    },
    methods: {
        submit() {
            this.form.patch(this.route('channels.variables.update', {channel: this.channel, variable: this.variable}), {
                onFinish: () => this.form.reset(),
            });
        },
    },
});
</script>

<style scoped>

</style>
