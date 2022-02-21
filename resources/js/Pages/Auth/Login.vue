<template>
    <in-head title="Connexion"/>
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                     alt="Workflow"/>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Connexion</h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Ou
                    {{ ' ' }}
                    <in-link :href="route('register')" class="font-medium text-indigo-600 hover:text-indigo-500"> Créer
                        votre
                        compte
                    </in-link>
                </p>
            </div>
            <jet-validation-errors class="mb-4 mt-4"/>
            <form @submit.prevent="submit">
                <div class="rounded-md shadow-sm -space-y-px">
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
                </div>

                <div class="flex items-center justify-between pt-4 pb-4">
                    <div class="block">
                        <label class="flex items-center">
                            <jet-checkbox name="remember" v-model:checked="form.remember"/>
                            <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                        </label>
                    </div>

                    <div class="text-sm">
                        <in-link :href="route('password.request')"
                              class="font-medium text-indigo-600 hover:text-indigo-500">Mot de passe oublier?
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
                        Connexion
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import {defineComponent} from 'vue';
import {Head as InHead, Link as InLink} from '@inertiajs/inertia-vue3';
import {LockClosedIcon} from "@heroicons/vue/solid";
import JetValidationErrors from "@/Jetstream/ValidationErrors";
import JetCheckbox from "@/Jetstream/Checkbox";

export default defineComponent({
    components: {
        JetValidationErrors,
        InHead, InLink,
        LockClosedIcon,
        JetCheckbox,
    },

    props: {
        canResetPassword: Boolean,
        status: String,
        errors: [Object, Array, null],
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form
                .transform(data => ({
                    ...data,
                    remember: this.form.remember ? 'on' : ''
                }))
                .post(this.route('login'), {
                    onFinish: () => this.form.reset('password'),
                })
        }
    }
})
</script>
