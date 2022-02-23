<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Visualisation historique
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                        <div
                            class="p-6 sm:px-20 bg-white border-b border-gray-200 text-center flex justify-center flex-col">
                            <div class="mt-8 text-2xl">
                                Visualisation historique
                            </div>
                            <div class="mt-8">
                                <div class="flex flex-cols justify-content-around">
                                    <div class="w-full pr-2">
                                        <label class="text-gray-900" for="canal">Canal: </label>
                                        <select :disabled="channels.length <= 0" id="canal" v-model="channel"
                                                class="disabled:bg-gray-200 form-select form-select-sm appearance-none block w-full px-2 py-1 text-sm font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                            <option v-for="c in channels" :key="c.id" :value="c"
                                                    :selected="channel.id === c.id">
                                                {{ c.title }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="w-full pl-2">
                                        <label class="text-gray-900" for="variable">Variable: </label>
                                        <select :disabled="variables.length <= 0" id="variable" v-model="variable"
                                                class="disabled:bg-gray-200 form-select form-select-sm appearance-none block w-full px-2 py-1 text-sm font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                            <option v-for="variable in variables" :key="variable.id"
                                                    :value="variable">
                                                {{ variable.title }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="w-full mt-4">
                                    <button @click="handleFetchButton" :disabled="channel === null || variable === null"
                                            type="button"
                                            class="mb-2 w-full inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-normal uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                        Afficher
                                    </button>
                                </div>
                            </div>
                            <hr class="mt-8 bg-gray-300 w-full" v-if="chartEnabled"/>
                            <div class="mt-8" v-if="chartEnabled">
                                <vue3-chart-js ref="chart" :data="chartData" type="line"/>
                            </div>
                            <div class="w-full mt-4" v-if="chartEnabled">
                                <button @click="downloadChartImage"
                                        type="button"
                                        class="mb-2 w-full inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-normal uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                    Télécharger le graph en PNG
                                </button>
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
import Vue3ChartJs from "@j-t-mcc/vue3-chartjs";

export default {
    components: {AppLayout, Vue3ChartJs},
    name: "History",
    props: {
        channels: Array,
        data: Array,
    },
    data() {
        return {
            channel: this.channels.length > 0 ? this.channels[0] : null,
            variable: this.channels.length > 0 && this.channels[0].variables.length > 0 ? this.channels[0].variables[0] : null,
        };
    },
    computed: {
        variables() {
            return this.channel != null ? this.channel.variables ?? [] : [];
        },
        labels() {
            if (this.data.length > 0) {
                let data = this.data;
                return data.map(element => element.hasOwnProperty('created_at') ? element.created_at : Date.now());
            }
            return null;
        },
        values() {
            if (this.data.length > 0) {
                let data = this.data;
                return data.map(element => element.value ? 1 : 0);
            }
            return null;
        },
        chartData() {
            if (this.chartEnabled)
                return {
                    labels: this.labels,
                    datasets: [
                        {
                            label: `Variation de la variable ${this.variable.title} au sein du canal ${this.channel.title}`,
                            data: this.values,
                            fill: false,
                            borderColor: "#41B883",
                            backgroundColor: "black",
                        }
                    ],
                }
            return {};
        },
        chartEnabled() {
            return this.channel != null && this.variable != null && this.data.length > 0;
        },
    },
    methods: {
        handleFetchButton() {
            this.$inertia.visit(this.route('channels.variables.data.fetchHistory', {
                channel: this.channel.id,
                variable: this.variable.id,
            }), {
                replace: true,
                preserveState: true,
            });
        },
        downloadChartImage() {
            let a = document.createElement('a');
            a.href = this.$refs.chart.chartJSState.chart.toBase64Image();
            a.download = 'image-export.png';
            a.click();
            a = null;
        }
    },
}
</script>

<style scoped>

</style>
