<template>
    <in-head title="Register"/>

    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                     alt="Workflow"/>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Créer mon compte</h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Ou
                    {{ ' ' }}
                    <in-link :href="route('login')" class="font-medium text-indigo-600 hover:text-indigo-500"> Se connecter si vous avez déjà un compte </in-link>
                </p>
            </div>
            <jet-validation-errors class="mb-4 mt-4"/>
            <form @submit.prevent="submit">
                <div class="rounded-md shadow-sm -space-y-px">

                    <div>
                        <label for="name" class="sr-only">Votre nom et prénom</label>
                        <input id="name" name="name" v-model="form.name" type="text" autocomplete="name"
                               required=""
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="Nom et prénom"/>
                    </div>
                    <div>
                        <label for="email-address" class="sr-only">Adresse mail</label>
                        <input id="email-address" name="email" v-model="form.email" type="email" autocomplete="email"
                               required=""
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="Adresse mail"/>
                    </div>
                    <div>
                        <label for="password" class="sr-only">Mot de passe</label>
                        <input id="password" name="password" v-model="form.password" type="password"
                               autocomplete="current-password" required=""
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="Mot de passe"/>
                    </div>
                    <div>
                        <label for="password_confirmation" class="sr-only">Confirmation mot de passe</label>
                        <input id="password_confirmation" name="password_confirmation"
                               v-model="form.password_confirmation" type="password"
                               autocomplete="current-password" required=""
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="Confirmation mot de passe"/>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 pb-4">
                    <div class="block">
                        <label class="flex items-center">
                            <jet-checkbox name="remember" v-model:checked="form.remember"/>
                            <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                        </label>
                    </div>

                    <div class="text-sm">
                        <in-link :href="route('password.request')" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Mot de passe oublier? </in-link>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                          <lock-closed-icon class="h-5 w-5 text-white" aria-hidden="true"/>
                        </span>
                        Créer mon compte
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import {defineComponent} from 'vue';
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import {Head as InHead, Link as InLink} from '@inertiajs/inertia-vue3';
import ValidationErrors from "@/Jetstream/ValidationErrors";
import { LockClosedIcon } from '@heroicons/vue/solid';

export default defineComponent({
    components: {
        ValidationErrors,
        InHead,
        JetCheckbox,
        JetLabel,
        JetValidationErrors,
        InLink,
        LockClosedIcon,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
})
</script>
