<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { SET_GLOBALS_EVENT_TYPE } from './types/openai';

const router = useRouter();
const appDidLoad = ref(import.meta.env.PROD ? false : true);

if (!import.meta.env.PROD) {
    router.push({ name: 'performance' });
}

window.addEventListener(SET_GLOBALS_EVENT_TYPE, () => {
    appDidLoad.value = true;
    router.push({ name: 'performance' });
});
</script>

<template>
    <RouterView v-if="appDidLoad" />
</template>
