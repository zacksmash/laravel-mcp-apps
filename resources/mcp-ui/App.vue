<script setup>
import { useWidgetMeta } from '@mcp/composables/useWidgetMeta';
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const meta = useWidgetMeta();

onMounted(() => {
    router.push(meta.value?.route);
});
</script>

<template>
    <router-view />
</template>
