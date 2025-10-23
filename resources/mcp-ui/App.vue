<script setup>
import { useWidgetMeta } from '@mcp/composables/useOpenAiApp';
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const meta = useWidgetMeta();

onMounted(() => {
    router.push({ name: meta.value?.route });
});
</script>

<template>
    <router-view />
</template>
