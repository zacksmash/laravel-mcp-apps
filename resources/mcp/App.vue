<script setup lang="ts">
import { useWidgetMeta } from '@zacksmash/vue-open-ai-apps';
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const meta = useWidgetMeta() as any;

onMounted(() => {
    router.push({ name: meta.value?.route });
});
</script>

<template>
    <RouterView />
</template>
