<template>
    <div class="flex items-center">
        <input id="checkbox"  :value="value" v-model="proxyChecked" type="checkbox"
               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"/>
        <label for="checkbox" class="ml-2 block text-sm text-gray-900"> {{ label }} </label>
    </div>
</template>

<script>
export default {
    name: "CheckBox",
    emits: ['update:checked'],
    props: {
        checked: {
            type: [Array, Boolean],
            default: false,
        },
        value: {
            type: [Array, Boolean],
            default: false,
        },
        label: {
            type: String,
            required: true,
        },
    },
    computed: {
        proxyChecked: {
            get() {
                return this.checked;
            },

            set(val) {
                this.$emit("update:checked", val);
            },
        },
    },
}
</script>

<style scoped>

</style>
