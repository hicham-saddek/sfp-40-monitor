<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Visualisation temps réel
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                        <div
                            class="p-6 sm:px-20 bg-white border-b border-gray-200 text-center flex justify-center flex-col">
                            <div class="mt-8 text-2xl">
                                Visualisation temps réel
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
                            <div class="mt-8 w-full" v-if="chartEnabled">
                                <select v-model="maxValues"
                                        class="disabled:bg-gray-200 form-select form-select-sm appearance-none block w-full px-2 py-1 text-sm font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="75">75</option>
                                    <option value="99999999">All</option>
                                </select>
                            </div>
                            <div class="mt-4" v-if="chartEnabled">
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
    name: "Realtime",
    props: {
        channels: Array,
        data: Array,
        realtimeEnabled: {
            type: Boolean,
            default: false,
        }
    },
    data() {
        return {
            channel: this.channels.length > 0 ? this.channels[0] : null,
            variable: this.channels.length > 0 && this.channels[0].variables.length > 0 ? this.channels[0].variables[0] : null,
            broadcast: null,
            subscription: null,
            fetch: false,
            maxValues: 25,
        };
    },
    computed: {
        variables() {
            return this.channel != null ? this.channel.variables ?? [] : [];
        },
        labels() {
            if (!this.realtimeEnabled) return null;
            if (this.data.length > 0) {
                let data = this.data;
                return data.map(element => element != null && element.hasOwnProperty('created_at') ? element.created_at : Date.now());
            }
            return null;
        },
        values() {
            if (!this.realtimeEnabled) return null;
            if (this.data.length > 0) {
                let data = this.data;
                return data.map(element => element != null && element.value ? 1 : 0);
            }
            return null;
        },
        chartData() {
            if (!this.realtimeEnabled) return {};
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
            return this.channel != null && this.variable != null && this.data.length > 0 && this.realtimeEnabled;
        },
    },
    methods: {
        handleFetchButton() {
            this.$inertia.get(this.route('channels.variables.data.fetchRealtime', {
                channel: this.channel.id,
                variable: this.variable.id,
            }));
        },
        downloadChartImage() {
            let a = document.createElement('a');
            a.href = this.$refs.chart.chartJSState.chart.toBase64Image();
            a.download = 'image-export.png';
            a.click();
            a = null;
        },
        enableRealtime() {
            if (!this.realtimeEnabled) return;
            if (this.broadcast != null) {
                this.stopListen();
                this.broadcast = null;
            }
            this.subscription = `data-entry-of-${this.variable.id}`;
            this.broadcast = Echo.private(this.subscription);
            this.broadcast.pusher.bind('new-entry', this.addData);
        },
        addData(event) {
            if (this.$refs.chart == null) return;
            this.data.push(event.data);
            this.$refs.chart.chartJSState.props.data.datasets[0].data.push(event.data.value ? 1 : 0);
            this.$refs.chart.chartJSState.props.data.labels.push(this.date(event.data.created_at));
            if (this.data.length > this.maxValues) {
                this.data.shift();
                this.$refs.chart.chartJSState.props.data.labels.shift();
                this.$refs.chart.chartJSState.props.data.datasets[0].data.shift();
            }
            this.$refs.chart.chartJSState.props.data.datasets[0].label = `Variation de la variable ${this.variable.title} au sein du canal ${this.channel.title}`;
            this.$refs.chart.update();
        },
        stopListen() {
            if (this.broadcast) {
                this.broadcast.stopListening(this.subscription);
            }
        },
        date(timestamp) {
            let date = new Date(timestamp);
            return `${date.getDay()}/${date.getMonth()} à ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`;
        }
    },
    mounted() {
        this.enableRealtime();
    },
    beforeUnmount() {
        this.stopListen();
    }
}
</script>

<style scoped>

</style>
