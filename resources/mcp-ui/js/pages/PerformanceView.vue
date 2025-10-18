<script setup lang="ts">
import { useOpenAiGlobal } from '@/composables/useOpenAiGlobal';

const toolOutput = useOpenAiGlobal('toolOutput');
</script>

<template>
    <div class="bg-white p-1 dark:bg-gray-900" v-if="toolOutput?.stats?.length">
        <div class="mx-auto max-w-7xl">
            <div
                class="grid grid-cols-1 gap-px overflow-hidden rounded-2xl border border-gray-900/5 bg-gray-900/5 shadow-sm sm:grid-cols-2 md:grid-cols-4 dark:border-white/10 dark:bg-white/10"
            >
                <div
                    class="bg-white px-4 py-6 sm:px-6 lg:px-8 dark:bg-gray-950/25"
                    v-for="stat in toolOutput.stats"
                    :key="stat.id"
                >
                    <p
                        class="text-sm/6 font-medium text-gray-500 dark:text-gray-400"
                    >
                        {{ stat.name }}
                    </p>
                    <p class="mt-2 flex items-baseline gap-x-2">
                        <span
                            class="text-4xl font-semibold tracking-tight text-gray-900 dark:text-white"
                            >{{ stat.value }}</span
                        >
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
