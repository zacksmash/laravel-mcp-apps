<script setup>
import { SET_GLOBALS_EVENT_TYPE } from './types/openai';
import PerformanceView from '@/pages/PerformanceView.vue';
import { ref } from 'vue';

const appDidLoad = ref(import.meta.env.PROD ? false : true);
window.addEventListener(SET_GLOBALS_EVENT_TYPE, () => {
    appDidLoad.value = true;
});
</script>

<template>
    <PerformanceView v-if="appDidLoad" />
</template>
