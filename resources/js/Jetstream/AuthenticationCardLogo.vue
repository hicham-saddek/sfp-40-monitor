<template>
    <in-link href="/">
        <logo />
    </in-link>
</template>
<script>
import { defineComponent} from "vue";
import Logo from "@/Components/Logo";
import { Link as InLink } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {Logo, InLink}
});
</script>
