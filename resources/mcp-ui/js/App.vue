<script setup>
import { useComponent } from '@/composables/useComponent';

const component = useComponent('performance');
</script>

<template>
    <component :is="component" />
</template>
