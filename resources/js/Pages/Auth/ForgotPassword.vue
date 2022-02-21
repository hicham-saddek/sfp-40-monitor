<template>
    <in-head title="Mot de passe oublié" />
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                     alt="Workflow"/>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Mot de passe oublié</h2>
                <div class="mb-4 text-sm text-gray-600 mt-4">
                    Vous avez oublié votre mot de passe ? Pas de problème, vous pouvez nous donner votre adresse mail universitaire et on va vous envoyer un lien par e-mail qui va vous permettre de renouveler votre mot de passe.
                </div>
            </div>
            <jet-validation-errors class="mb-4 mt-4"/>
            <form @submit.prevent="submit">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email-address" class="sr-only">Adresse mail</label>
                        <input id="email-address" name="email" v-model="form.email" type="email" autocomplete="email"
                               required=""
                               class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="Adresse mail"/>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 pb-4">
                    <div class="text-sm">
                        <in-link :href="route('login')"
                              class="font-medium text-indigo-600 hover:text-indigo-500">Connexion
                        </in-link>
                    </div>
                    <div class="text-sm">
                        <in-link :href="route('register')"
                              class="font-medium text-indigo-600 hover:text-indigo-500">Créer mon un nouveau compte
                        </in-link>
                    </div>
                </div>

                <div>
                    <button type="submit" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                          <lock-closed-icon class="h-5 w-5 text-white" aria-hidden="true"/>
                        </span>
                        Envoyer moi mon lien de renouvellement
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head as InHead, Link as InLink } from '@inertiajs/inertia-vue3';
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
    import {LockClosedIcon} from '@heroicons/vue/solid';

    export default defineComponent({
        components: {
            InHead, InLink,
            JetValidationErrors,
            LockClosedIcon,
        },

        props: {
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: ''
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.email'))
            }
        }
    })
</script>
