<script setup>
import { useComponent } from '@mcp/composables/useComponent';

const component = useComponent('performance');
</script>

<template>
    <component :is="component" />
</template>
