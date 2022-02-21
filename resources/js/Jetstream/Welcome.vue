<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200 text-center flex justify-center flex-col">
            <jet-application-logo class="block h-12 w-auto"/>

            <div class="mt-8 text-2xl">
                Bienvenu sur SF4.0Monitor !
            </div>

            <div class="mt-6 text-gray-500">
                Cette plateforme Industrie 4.0 vous permet de monitorer vos données qui se trouve du SFP en toute
                sécurité tout en respectant les normes de l'industrie 4.0 et de l'IoT.
            </div>
        </div>
    </div>
</template>

<script>
import {defineComponent} from 'vue'
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'

export default defineComponent({
    components: {
        JetApplicationLogo,
    },
})
</script>
