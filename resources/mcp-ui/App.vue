<script setup>
import { useWidgetView } from '@mcp/composables/useWidgetView';

const component = useWidgetView('performance');
</script>

<template>
    <component :is="component" />
</template>
