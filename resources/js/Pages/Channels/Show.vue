<template>
    <in-head :title='"Canal (" + channel.title + ")"'/>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Canal ({{ channel.title }})
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="p-6 sm:px-20 bg-white border-b border-gray-200 text-center flex justify-center flex-col">
                        <div class="mt-8 text-2xl">
                            {{ channel.title }}
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full items-center text-center"
                                :class="{ 'bg-green-100': channel.active, 'bg-red-100': !channel.active, 'text-green-800': channel.active, 'text-red-800': ! channel.active }"> {{
                                    channel.active ? 'Monitoring Activer' : 'Monitoring Désactiver'
                                }} </span>
                        </div>
                        <p class="mt-2 text-md">{{ channel.description }}</p>
                        <div class="mt-2 mb-8 text-sm text-gray-500">
                            Ajouter un nouveau canal de données, le titre et la description sont des attributs qui vont vous aider à identifier votre canal,
                            ce canal représentera l'interface <strong>SFP4.0Collector</strong> que vous pouvez installer sur chaque poste de votre système.
                            La variable <code>OPC</code> représente le lien du serveur complet, en format <code>opc.tcp</code>.
                            La variable <code>Synchronisation</code> représente la fréquence de synchronisation de la collecte par votre collecteur.
                        </div>
                        <div class="-my-2sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div>
                                  <span class="left-0 text-sm text-gray-500">
                                      <strong class="font-bold text-gray-700">Titre: </strong>
                                      {{ channel.title }}
                                  </span>
                                </div>
                                <div>
                                  <span class="left-0 text-sm text-gray-500">
                                      <strong class="font-bold text-gray-700">Description: </strong>
                                      {{ channel.description }}
                                  </span>
                                </div>
                                <div>
                                  <span class="left-0 text-sm text-gray-500">
                                      <strong class="font-bold text-gray-700">Lien du serveur OPC-UA: </strong>
                                      {{ channel.opc }}
                                  </span>
                                </div>
                                <div>
                                  <span class="left-0 text-sm text-gray-500">
                                      <strong class="font-bold text-gray-700">Synchronisation: </strong>
                                      {{ channel.clock }}
                                  </span>
                                </div>

                                <div
                                    class="mt-8 rounded-md w-full block items-center justify-items-center content-center flex flex-row">
                                    <in-link :href="route('channels.edit', {channel: channel})"
                                             class="bg-indigo-600 py-2 basis-1/2 hover:bg-indigo-800 focus:bg-indigo-800 text-sm text-center text-white font-bold rounded-none rounded-tl-md rounded-bl-md">
                                        Modifier
                                    </in-link>
                                    <button @click="confirmChannelDeletion"
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
        <jet-dialog-modal :show="confirmingChannelDeletion" @close="closeModal">
            <template #title>
                Supprimer la variable ({{ channel.title }})
            </template>

            <template #content>
                Etes vous sûr de vouloir supprimer ce canal, si vous supprimez ce canal tout l'historique de votre canal sera supprimer aussi, ainsi que toutes les variables déclarer dedent, si vous ne voulez pas perdre vos données, désactiver l'affichage du cananl pour préservé les données son historique, elle peut être réactiver à tout autre moment.
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    Annuler
                </jet-secondary-button>

                <jet-danger-button class="ml-3" @click="deleteChannel" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
        channel: Object,
    },
    data() {
        return {
            confirmingChannelDeletion: false,
            form: this.$inertia.form(),
        };
    },
    methods: {
        confirmChannelDeletion() {
            this.confirmingChannelDeletion = true;
        },
        success() {
            this.closeModal();
            alert('Le canal a été bien supprimé');
        },
        deleteChannel() {
            this.form.delete(this.route('channels.delete', {channel: this.channel}), {
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
