<script setup lang="ts">
import { useWidgetProps } from '@mcp/composables/useWidgetProps';
import { useWidgetState } from '@mcp/composables/useWidgetState';
import { computed, ComputedRef, onMounted } from 'vue';

const toolOutput = useWidgetProps();
const { widgetState, setWidgetState } = useWidgetState();

const stats = computed(() => {
    return toolOutput.value?.stats ?? [];
}) as ComputedRef<Array<{ id: string; name: string; value: string }>>;

const onUpdateState = async () => {
    const newState = widgetState.value?.something === 'everything' ? 'nothing' : 'everything';

    await setWidgetState({ something: newState }).then(() => {
        console.log('widgetState', widgetState.value);
    });
};

onMounted(() => {
    console.log('openai', window.openai);
});
</script>

<template>
    <div class="bg-white dark:bg-stone-900">
        <div class="mx-auto max-w-7xl">
            <div v-if="stats.length" class="grid grid-cols-1 gap-px bg-gray-900/5 sm:grid-cols-2 md:grid-cols-4 dark:bg-white/10">
                <div class="bg-white px-4 py-6 sm:px-6 lg:px-8 dark:bg-gray-950/25" v-for="stat in stats" :key="stat.id">
                    <p class="text-sm/6 font-medium text-gray-500 dark:text-gray-400">
                        {{ stat.name }}
                    </p>
                    <p class="mt-2 flex items-baseline gap-x-2">
                        <span class="text-4xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ stat.value }}</span>
                    </p>
                </div>
            </div>

            <div class="p-4 text-white">
                <button
                    @click="onUpdateState()"
                    class="rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                >
                    Reset State
                </button>

                <h1 v-if="widgetState?.something === 'everything'">This is everything!</h1>
            </div>
        </div>
    </div>
</template>
