<script setup>
import { onBeforeMount } from 'vue';
import { useRouter } from 'vue-router';
import { useWidgetMeta } from './composables/useWidgetMeta';

const router = useRouter();
const toolMeta = useWidgetMeta({
    route: '/weather',
});

onBeforeMount(() => {
    router.push(toolMeta.value.route);
});
</script>

<template>
    <router-view />
</template>
