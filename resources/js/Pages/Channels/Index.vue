<template>
    <in-head title="Liste des canaux de données"/>
    <app-layout title="canaux de données">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Liste des canaux de données
                </h2>
                <in-link :href="route('channels.create')"
                         class="rounded-md py-2 px-4 text-sm text-white bg-indigo-600 hover:bg-indigo-800 focus:bg-indigo-800">
                    Ajouter un nouveau canal de données
                </in-link>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Canal
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Identification
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Serveur OPC-UA
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Synchronisation
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Etat du monitoring
                                        </th>
                                        <th scope="col" colspan="4"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="channel in pages.data" :key="channel.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">
                                                {{ channel.slug }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Titre: {{ channel.title }}</div>
                                            <div class="text-sm text-gray-500">Description: {{
                                                    channel.description
                                                }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">
                                                {{ channel.opc }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">
                                                Chaque {{ channel.clock }} s
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center items-center">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full items-center text-center"
                                                :class="{ 'bg-green-100': channel.active, 'bg-red-100': !channel.active, 'text-green-800': channel.active, 'text-red-800': ! channel.active }"> {{
                                                    channel.active ? 'Monitoring Activer' : 'Monitoring Désactiver'
                                                }} </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <in-link :href="route('channels.show', {channel: channel.id})"
                                                     class="text-green-600 hover:text-green-900">Afficher
                                            </in-link>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <in-link :href="route('channels.edit', {channel: channel.id})"
                                                     class="text-indigo-600 hover:text-indigo-900">Modifier
                                            </in-link>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button @click="toggleMonitoring(channel.id)"
                                                     class="text-indigo-600 hover:text-indigo-900">{{ channel.active ? "Désactiver" : "Activer" }}
                                            </button>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <in-link :href="route('channels.variables.index', {channel: channel.id})"
                                                     class="text-indigo-600 hover:text-indigo-900">Variables
                                            </in-link>
                                        </td>
                                    </tr>
                                    <tr v-if="pages.data.length <= 0">
                                        <td class="px-6 py-4 whitespace-nowrap" colspan="9">
                                            <div class="text-sm text-gray-900">Aucun canal de données n'as été créer pour
                                                l'instant, rajouter des canaux de données afin de voir leurs avancements ici :).
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="bg-white border-t border-gray-200">
                                        <td class="px-6 py-4 whitespace-nowrap" colspan="9">
                                            <div class="flex-1 flex justify-between sm:hidden">
                                                <in-link :href="pages.prev_page_url"
                                                         class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                                    Précédent
                                                </in-link>
                                                <in-link :href="pages.next_page_url"
                                                         class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                                    Suivant
                                                </in-link>
                                            </div>
                                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                                <div>
                                                    <p class="text-sm text-gray-700">
                                                        Données de
                                                        {{ ' ' }}
                                                        <span class="font-medium">{{ pages.from }}</span>
                                                        {{ ' ' }}
                                                        à
                                                        {{ ' ' }}
                                                        <span class="font-medium">{{ pages.to }}</span>
                                                        {{ ' ' }}
                                                        de
                                                        {{ ' ' }}
                                                        <span class="font-medium">{{ pages.total }}</span>
                                                        {{ ' ' }}
                                                        résultats
                                                    </p>
                                                </div>
                                                <div>
                                                    <nav
                                                        class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                                        aria-label="Pagination">
                                                        <in-link :href="pages.first_page_url"
                                                                 class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                            <span class="sr-only">Début</span>
                                                            <ChevronLeftIcon class="h-5 w-5" aria-hidden="true"/>
                                                        </in-link>

                                                        <template v-for="(link, i) in pages.links" :key="i">
                                                            <in-link v-if="isPrevious(link.label)" :href="link.url"
                                                                     arria-current="page"
                                                                     :class='link.active ? "z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium" : "bg-white border-gray-300 text-gray-500 hover:bg-gray-50 hidden md:inline-flex relative items-center px-4 py-2 border text-sm font-medium"'>
                                                                <span class="sr-only">Précédent</span>
                                                                <ChevronLeftIcon class="h-5 w-5" aria-hidden="true"/>
                                                            </in-link>
                                                            <in-link v-else-if="isNext(link.label)" :href="link.url"
                                                                     arria-current="page"
                                                                     :class='link.active ? "z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium" : "bg-white border-gray-300 text-gray-500 hover:bg-gray-50 hidden md:inline-flex relative items-center px-4 py-2 border text-sm font-medium"'>
                                                                <span class="sr-only">Suivant</span>
                                                                <ChevronRightIcon class="h-5 w-5" aria-hidden="true"/>
                                                            </in-link>
                                                            <in-link v-else :href="link.url" arria-current="page"
                                                                     :class='link.active ? "z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium" : "bg-white border-gray-300 text-gray-500 hover:bg-gray-50 hidden md:inline-flex relative items-center px-4 py-2 border text-sm font-medium"'>
                                                                {{ link.label }}
                                                            </in-link>
                                                        </template>

                                                        <in-link :href="pages.last_page_url"
                                                                 class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                            <span class="sr-only">Fin</span>
                                                            <ChevronRightIcon class="h-5 w-5" aria-hidden="true"/>
                                                        </in-link>
                                                    </nav>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import {defineComponent} from 'vue';
import {Head as InHead, Link as InLink} from '@inertiajs/inertia-vue3';
import {ChevronLeftIcon, ChevronRightIcon} from '@heroicons/vue/solid';

export default defineComponent({
    components: {AppLayout, InHead, InLink, ChevronLeftIcon, ChevronRightIcon},
    name: "Index",
    props: {
        pages: {
            type: Object,
            default: {},
        },
    },
    methods: {
        isPrevious(label) {
            return label.toString().endsWith('Previous');
        },
        isNext(label) {
            return label.toString().startsWith('Next');
        },
        toggleMonitoring(channel){
            this.$inertia.visit(this.route('channels.toggleMonitoring', {channel: channel}), {
                method: "patch",
                replace: true
            });
        }
    },
});
</script>
