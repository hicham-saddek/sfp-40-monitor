<template>
    <in-head title="Bienvenu"/>
    <div class="relative bg-white h-screen">
        <div class="max-w-7xl mx-auto h-full">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 h-full">
                <Popover>
                    <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                        <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start"
                             aria-label="Global">
                            <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                                <div class="flex items-center justify-between w-full md:w-auto">
                                    <in-link href="/">
                                        <span class="sr-only">SFP4.0Monitor</span>
                                        <logo/>
                                    </in-link>
                                    <div class="-mr-2 flex items-center md:hidden">
                                        <PopoverButton
                                            class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                            <span class="sr-only">Ouvrir le menu déroulant</span>
                                            <MenuIcon class="h-6 w-6" aria-hidden="true"/>
                                        </PopoverButton>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden md:block md:ml-10 md:pr-4 md:space-x-8">
                                <in-link v-for="item in ownNavigations()" :key="item.name" :href="item.href"
                                         class="font-medium text-gray-500 hover:text-gray-900">{{ item.name }}
                                </in-link>
                                <a v-for="item in outNavigations()" :key="item.name" :href="item.href" target="_blank"
                                   class="font-medium text-gray-500 hover:text-gray-900">{{ item.name }}</a>
                                <in-link :href="route('login')"
                                         class="font-medium text-indigo-600 hover:text-indigo-500">Connexion
                                </in-link>
                                <in-link :href="route('register')"
                                         class="font-medium text-indigo-400 hover:text-indigo-500">Créer un compte
                                </in-link>
                            </div>
                        </nav>
                    </div>

                    <transition enter-active-class="duration-150 ease-out" enter-from-class="opacity-0 scale-95"
                                enter-to-class="opacity-100 scale-100" leave-active-class="duration-100 ease-in"
                                leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
                        <PopoverPanel focus
                                      class="absolute z-10 top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
                            <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
                                <div class="px-5 pt-4 flex items-center justify-between">
                                    <div>
                                        <img class="h-8 w-auto"
                                             src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                                             alt=""/>
                                    </div>
                                    <div class="-mr-2">
                                        <PopoverButton
                                            class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                            <span class="sr-only">Fermer le menu déroulant</span>
                                            <XIcon class="h-6 w-6" aria-hidden="true"/>
                                        </PopoverButton>
                                    </div>
                                </div>
                                <div class="px-2 pt-2 pb-3 space-y-1">
                                    <in-link v-for="item in ownNavigations()" :key="item.name" :href="item.href"
                                             class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                                        {{ item.name }}
                                    </in-link>
                                    <a v-for="item in outNavigations()" :key="item.name" target="_blank"
                                       :href="item.href"
                                       class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">{{
                                            item.name
                                        }}</a>
                                </div>
                                <in-link :href="route('login')"
                                         class="block w-full px-5 py-3 text-center font-medium text-indigo-600 bg-gray-50 hover:bg-gray-100">
                                    Connexion
                                </in-link>
                                <in-link :href="route('register')"
                                         class="block w-full px-5 py-3 text-center font-medium text-indigo-600 bg-gray-50 hover:bg-gray-100">
                                    Créer un compte
                                </in-link>
                            </div>
                        </PopoverPanel>
                    </transition>
                </Popover>
                <main
                    class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28 h-full flex justify-center">
                    <div class="sm:text-center lg:text-left self-center">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Monitorer vos données</span>
                            {{ ' ' }}
                            <span class="block text-indigo-600 xl:inline">en toute simplicité</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            <strong>SFP4.0Monitor</strong> vous permets de monitorer vos données en toute simplicité
                            tout en étant sûr d'avoir une bonne sécurité pour vos données sensibles.</p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <in-link :href="route('login')"
                                         class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                    Connexion
                                </in-link>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <in-link :href="route('register')"
                                         class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg md:px-10">
                                    Créer mon compte
                                </in-link>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <svg class="hidden absolute lg:block inset-y-0 h-full w-48 text-white transform translate-x1/2"
                 fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                <polygon points="0,0 100,0 50,100 0,100"/>
            </svg>
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                 src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80"
                 alt=""/>
        </div>
    </div>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Ce qu'on vous rapporte</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">Surveillez
                    l'ensemble de votre infrastructure</p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">Permettre à l’utilisateur de visualiser et/ou
                    requérir au travers d’interfaces de communication un ensemble d’informations générées par le SFP</p>
            </div>
            <div class="mt-10">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    <div v-for="feature in features" :key="feature.name" class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <component :is="feature.icon" class="h-6 w-6" aria-hidden="true"/>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">{{ feature.name }}</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            {{ feature.description }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="text-2xl font-medium title-font mb-4 text-gray-900">Notre équipe</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Notre équipe de développement du projet, sous
                    l'encadrement de M. Sylvain Kubler, M.JY Bron, Mme. Pascale Marange, M. Eric Rondeau.</p>
            </div>
            <div class="flex items-center align-items-center justify-items-center justify-center -m-4">
                <div v-for="(teamMember, index) in teamMembers" :key="index" class="p-4 lg:w-1/4 md:w-1/2">
                    <div class="h-full flex flex-col items-center text-center">
                        <img alt="team" class="flex-shrink-0 rounded-full w-56 h-56 object-cover object-center mb-4"
                             :src="teamMember.image">
                        <div class="w-full">
                            <h2 class="title-font font-medium text-lg text-gray-900">{{ teamMember.name }}</h2>
                            <h3 class="text-gray-500 mb-3">{{ teamMember.role }}</h3>
                            <p class="mb-4">{{ teamMember.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {defineComponent} from 'vue'
import {Head as InHead, Link as InLink} from '@inertiajs/inertia-vue3';
import {Popover, PopoverButton, PopoverPanel} from '@headlessui/vue'
import {AnnotationIcon, GlobeAltIcon, LightningBoltIcon, MenuIcon, ScaleIcon, XIcon} from '@heroicons/vue/outline';
import Logo from '@/Components/Logo';

export default defineComponent({
    components: {
        InHead,
        InLink,
        Logo,
        Popover,
        PopoverButton,
        PopoverPanel,
        MenuIcon,
        XIcon,
        AnnotationIcon, GlobeAltIcon, LightningBoltIcon, ScaleIcon,
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
    data() {
        return {
            navigation: [
                {name: 'AIP Lorraine', href: 'https://aip-primeca.univ-lorraine.fr/', out: true},
            ],
            features: [
                {
                    name: 'Surveillance des infrastructures',
                    description: 'Disponibilité, performances et tendances : Connaître l\'état de tout à tout moment. Soyez flexible lors de la création et de la mise à l\'échelle de votre configuration de surveillance.',
                    icon: GlobeAltIcon,
                },
                {
                    name: 'Surveillance en Cloud',
                    description: 'Surveillez les clouds privés, publics ou hybrides dans un seul système de surveillance et restez indépendant de votre fournisseur de cloud avec votre surveillance.',
                    icon: ScaleIcon,
                },
                {
                    name: 'Métriques et journaux',
                    description: 'Nos intégrations vous permettent de collecter, stocker, visualiser et combiner des données de performances et de métriques en cours de route. Soyez alerté sur les modèles.',
                    icon: LightningBoltIcon,
                },
                {
                    name: 'Analytique',
                    description: 'Découvrez les relations et les modèles. Créez des rapports avec vos données existantes pour différents aspects. Filtrez certains serveurs/VM pour obtenir des informations dédiées.',
                    icon: AnnotationIcon,
                },
            ],
            teamMembers: [
                {
                    name: "Hicham SADDEK",
                    description: "Étudiant Master 2 ISC parcours RESET",
                    email: "hicham.saddek9@etu.univ-lorraine.fr",
                    role: "Responsable technique",
                    image: "https://media-exp1.licdn.com/dms/image/C4D03AQEF1ku4AS0H-g/profile-displayphoto-shrink_800_800/0/1635346988422?e=1649894400&v=beta&t=5MzduvLLo1ic15m6VOaoQ0loXrVUuUnaekGTvIXfJSI",
                },
                {
                    name: "Toufik MOUSSOUS",
                    description: "Étudiant Master 2 ISC parcours RESET",
                    email: "toufik.moussous6@etu.univ-lorraine.fr",
                    role: "Responsable ingénierie systèmes",
                    image: "https://media-exp1.licdn.com/dms/image/C4D03AQG8QrQ8C5tEEA/profile-displayphoto-shrink_800_800/0/1644174105759?e=1649894400&v=beta&t=zPi2XqjHW_odAVr-OprDNw3gmi4_2JAWabd9uLi3MDw",
                },
            ],
        };
    },
    methods: {
        ownNavigations() {
            return this.navigation.filter(e => ! e.out);
        },
        outNavigations() {
            return this.navigation.filter(e => e.out);
        }
    },
})
</script>

<style>
.h-screen {
    height: 100vh;
}
</style>
