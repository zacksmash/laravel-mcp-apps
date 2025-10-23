<script setup lang="ts">
import { useWidgetProps, useWidgetState } from '@mcp/composables/useOpenAiApp';
import { type WeatherWidgetData, type WeatherWidgetState } from '@mcp/types';
import { computed, Ref } from 'vue';

const { widgetState, setWidgetState } = useWidgetState<WeatherWidgetState>();
const toolOutput = useWidgetProps() as Ref<WeatherWidgetData>;

const unit = computed(() => {
    return widgetState.value?.units || 'f';
});

const onUpdateState = async (units: 'c' | 'f') => {
    await setWidgetState({ units });
};
</script>

<template>
    <div class="bg-gray-100 p-6">
        <div class="flex items-center justify-center" v-if="toolOutput">
            <div class="flex w-full max-w-xs flex-col rounded bg-white p-4">
                <div class="text-xl font-bold">{{ toolOutput.city }}</div>
                <div class="text-sm text-gray-500">
                    {{ toolOutput.date }}
                </div>
                <div class="my-6 flex items-center justify-around">
                    <div class="flex flex-col items-center justify-center rounded-md bg-gray-100 p-1 font-bold">
                        <button
                            @click="onUpdateState('f')"
                            :class="['rounded-sm px-3 py-2 transition-colors', widgetState?.units === 'f' || !widgetState ? 'bg-white text-sky-500' : '']"
                        >
                            F°
                        </button>
                        <button @click="onUpdateState('c')" :class="['rounded-sm px-3 py-2 transition-colors', widgetState?.units === 'c' ? 'bg-white text-sky-500' : '']">
                            C°
                        </button>
                    </div>
                    <div class="inline-flex size-24 items-center justify-center self-center rounded-lg text-6xl text-sky-500">
                        <svg class="size-24" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"
                            ></path>
                        </svg>
                    </div>
                </div>
                <div class="flex flex-row items-center justify-center">
                    <div class="text-6xl font-medium">{{ toolOutput.temp.current[unit] }}°</div>
                    <div class="ml-6 flex flex-col items-center">
                        <div>Cloudy</div>
                        <div class="mt-1">
                            <span class="text-sm"><i class="far fa-long-arrow-up"></i></span>
                            <span class="text-sm font-light text-gray-500">{{ toolOutput.temp.high[unit] }}°</span>
                        </div>
                        <div>
                            <span class="text-sm"><i class="far fa-long-arrow-down"></i></span>
                            <span class="text-sm font-light text-gray-500">{{ toolOutput.temp.low[unit] }}°</span>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex flex-row justify-between" v-if="toolOutput.conditions?.length">
                    <div class="flex flex-1 flex-col items-center" v-for="condition in toolOutput.conditions" :key="condition.label">
                        <div class="text-sm font-medium">
                            {{ condition.label }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ condition.value }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

// callTool // openExternal // sendFollowUpMessage // sendFollowUpTurn
