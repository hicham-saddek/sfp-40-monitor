<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <welcome/>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm-rounded-lg">
                    <div
                        class="p-6 sm:px-20 bg-white border-b border-gray-200 text-center flex justify-center flex-col">
                        <div class="mx-12 my-8 px-8 py-4">
                            <span class="text-lg font-extrabold text-black">Détails du système</span>
                        </div>
                        <monitoring-details :analytics="analytics"/>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import {defineComponent} from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import Welcome from '@/Jetstream/Welcome.vue'
import MonitoringDetails from "@/Pages/DashboardPartials/MonitoringDetails";

export default defineComponent({
    components: {
        MonitoringDetails,
        AppLayout,
        Welcome,
    },
    props: {
        analytics: {
            type: Array,
            default: [],
        },
    },
})
</script>
