<template>
    <jet-action-section>
        <template #title>
            Supprimer mon compte
        </template>

        <template #description>
            Supprimer définitivement mon compte
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                Une fois votre compte est supprimer, toutes vos données et le contenu de votre compte sera supprimer aussi, merci de télécharger toute information que vous voulez conserver avant de supprimer votre compte.
            </div>

            <div class="mt-5">
                <jet-danger-button @click="confirmUserDeletion">
                    Supprimer mon compte
                </jet-danger-button>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <jet-dialog-modal :show="confirmingUserDeletion" @close="closeModal">
                <template #title>
                    Supprimer mon compte
                </template>

                <template #content>
                    êtes vous sûr de vouloir supprimer votre compte? une fois supprimer, toutes vos données et le contenu de votre compte sera supprimer définitivement. Merci de renseigner votre mot de passe afin de confirmer que vous voulez vraiment supprimer votre compte.

                    <div class="mt-4">
                        <jet-input type="password" class="mt-1 block w-3/4" placeholder="Password"
                                    ref="password"
                                    v-model="form.password"
                                    @keyup.enter="deleteUser" />

                        <jet-input-error :message="form.errors.password" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Annuler
                    </jet-secondary-button>

                    <jet-danger-button class="ml-3" @click="deleteUser" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Supprimer mon compte
                    </jet-danger-button>
                </template>
            </jet-dialog-modal>
        </template>
    </jet-action-section>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetActionSection from '@/Jetstream/ActionSection.vue'
    import JetDialogModal from '@/Jetstream/DialogModal.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

    export default defineComponent({
        components: {
            JetActionSection,
            JetDangerButton,
            JetDialogModal,
            JetInput,
            JetInputError,
            JetSecondaryButton,
        },

        data() {
            return {
                confirmingUserDeletion: false,

                form: this.$inertia.form({
                    password: '',
                })
            }
        },

        methods: {
            confirmUserDeletion() {
                this.confirmingUserDeletion = true;

                setTimeout(() => this.$refs.password.focus(), 250)
            },

            deleteUser() {
                this.form.delete(route('current-user.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.password.focus(),
                    onFinish: () => this.form.reset(),
                })
            },

            closeModal() {
                this.confirmingUserDeletion = false

                this.form.reset()
            },
        },
    })
</script>
