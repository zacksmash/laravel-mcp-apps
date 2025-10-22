<script setup lang="ts">
import { useWidgetProps } from '@/composables/useWidgetProps';
import { useWidgetState } from '@/composables/useWidgetState';
import { computed, ComputedRef, onMounted } from 'vue';

const toolOutput = useWidgetProps();
const { widgetState, setWidgetState } = useWidgetState();

const stats = computed(() => {
    return toolOutput.value?.stats ?? [];
}) as ComputedRef<Array<{ id: string; name: string; value: string }>>;

const onUpdateState = async () => {
    await setWidgetState({ something: 'everything' }).then(() => {
        console.log(widgetState.value);
    });
};

onMounted(() => {
    console.log(widgetState.value);
});
</script>

<template>
    <div class="bg-white dark:bg-stone-900">
        <div class="mx-auto max-w-7xl">
            <div
                v-if="stats.length"
                class="grid grid-cols-1 gap-px bg-gray-900/5 sm:grid-cols-2 md:grid-cols-4 dark:bg-white/10"
            >
                <div
                    class="bg-white px-4 py-6 sm:px-6 lg:px-8 dark:bg-gray-950/25"
                    v-for="stat in stats"
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

            <div class="text-white">
                <button
                    @click="onUpdateState()"
                    class="mt-6 ml-6 rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                >
                    Reset State
                </button>

                <pre>
                    {{ widgetState }}
                </pre>
            </div>
        </div>
    </div>
</template>
