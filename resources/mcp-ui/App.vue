<script setup lang="ts">
import { useWidgetMeta } from '@mcp/composables/useOpenAI';
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const meta = useWidgetMeta() as any;

onMounted(() => {
    router.push({ name: meta.value?.route });
});
</script>

<template>
    <router-view />
</template>
