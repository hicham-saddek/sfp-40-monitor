<template>
    <in-head :title='"Variable (" + variable.title + ")"'/>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Variable ({{ variable.title }})
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="p-6 sm:px-20 bg-white border-b border-gray-200 text-center flex justify-center flex-col">
                        <div class="mt-8 text-2xl">{{ variable.title }}</div>
                        <p class="mt-2 text-md">{{ variable.description }}</p>
                        <div class="mt-2 mb-8 text-sm text-gray-500">
                            Ajouter une variable à monitorer, le titre et la description sont des attributs qui vont
                            vous aider à identifier votre variable, elle représente un capteur ou un actionneur de votre
                            système que vous souhaiter monitorer, 'Node ID' représente votre
                            capteur ou votre actionneur vous pouvez voir de la documentation de la plateforme
                            disponible pour plus de détails.
                        </div>
                        <div class="-my-2sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div>
                                  <span class="left-0 text-sm text-gray-500">
                                      <strong class="font-bold text-gray-700">Titre: </strong>
                                      {{ variable.title }}
                                  </span>
                                </div>
                                <div>
                                  <span class="left-0 text-sm text-gray-500">
                                      <strong class="font-bold text-gray-700">Description: </strong>
                                      {{ variable.description }}
                                  </span>
                                </div>
                                <div>
                                  <span class="left-0 text-sm text-gray-500">
                                      <strong class="font-bold text-gray-700">Node ID: </strong>
                                      {{ variable.node_id }}
                                  </span>
                                </div>

                                <div
                                    class="mt-8 rounded-md w-full block items-center justify-items-center content-center flex flex-row">
                                    <in-link :href="route('channels.variables.edit', {variable: variable, channel: channel})"
                                             class="bg-indigo-600 py-2 basis-1/2 hover:bg-indigo-800 focus:bg-indigo-800 text-sm text-center text-white font-bold rounded-none rounded-tl-md rounded-bl-md">
                                        Modifier
                                    </in-link>
                                    <button @click="confirmVariableDeletion"
                                        class="bg-red-600 py-2 basis-1/2 hover:bg-red-800 focus:bg-red-800 text-sm text-center text-white font-bold rounded-none rounded-tr-md rounded-br-md">
                                        Supprimer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Account Confirmation Modal -->
        <jet-dialog-modal :show="confirmingVariableDeletion" @close="closeModal">
            <template #title>
                Supprimer la variable ({{ variable.title }})
            </template>

            <template #content>
                Etes vous sûr de vouloir supprimer cette variable, si vous supprimer cette variables tout l'historique de votre variable sera supprimer aussi, si vous ne voulez pas perdre vos données, désactiver l'affichage de la variable pour préservé les données de votre variable et son historique, elle peut être réactiver à tout autre moment.
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    Annuler
                </jet-secondary-button>

                <jet-danger-button class="ml-3" @click="deleteVariable" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Supprimer la variable
                </jet-danger-button>
            </template>
        </jet-dialog-modal>
    </app-layout>
</template>

<script>
import {defineComponent} from "vue";
import {Head as InHead, Link as InLink} from '@inertiajs/inertia-vue3';
import AppLayout from "@/Layouts/AppLayout";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default defineComponent({
    components: {InHead, InLink, AppLayout, JetDialogModal, JetDangerButton, JetSecondaryButton},
    name: "Show",
    props: {
        variable: Object,
        channel: Object,
    },
    data() {
        return {
            confirmingVariableDeletion: false,
            form: this.$inertia.form(),
        };
    },
    methods: {
        confirmVariableDeletion() {
            this.confirmingVariableDeletion = true;
        },
        success() {
            this.closeModal();
            alert('La variable a été bien supprimé');
        },
        deleteVariable() {
            this.form.delete(this.route('channels.variables.delete', {variable: this.variable, channel: channel}), {
                preserveScroll: true,
                onSuccess: () => this.success(),
                onError: function () {
                    this.closeModal();
                    alert("Malheureusement, votre demande n'a pas abouti !")
                },
            });
        },
        closeModal(){
            this.confirmingVariableDeletion = false;
        }
    },
});
</script>
