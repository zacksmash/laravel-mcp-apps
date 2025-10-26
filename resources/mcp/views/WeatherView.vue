<script setup lang="ts">
import {
    useCallTool,
    useOpenExternal,
    useRequestDisplayMode,
    useSendFollowUpMessage,
    useWidgetProps,
    useWidgetState,
} from '@mcp/composables/openai';
import { type WeatherWidgetData, type WeatherWidgetState } from '@mcp/types';
import { computed, Ref, ref } from 'vue';

const { widgetState, setWidgetState } = useWidgetState<WeatherWidgetState>();
const toolOutput = useWidgetProps(() => ({
    city: 'Loading',
    date: 'Loading',
    temp: {
        current: { f: 0, c: 0 },
        high: { f: 0, c: 0 },
        low: { f: 0, c: 0 },
    },
    conditions: [
        { label: 'Humidity', value: 'Loading' },
        { label: 'Wind', value: 'Loading' },
        { label: 'Precipitation', value: 'Loading' },
    ],
})) as Ref<WeatherWidgetData>;
const callTool = useCallTool();
const openExternal = useOpenExternal();
const sendFollowUpMessage = useSendFollowUpMessage();
const requestDisplayMode = useRequestDisplayMode();
const isLoading = ref(false);

const unit = computed(() => {
    return widgetState.value?.units || 'f';
});

const onUpdateState = async (units: 'c' | 'f') => {
    await setWidgetState({ units });
};

const onSendFollowup = async () => {
    await sendFollowUpMessage('What is dark matter anyway?');
};

const onOpenExternal = () => {
    openExternal('https://www.weather.com/');
};

const onCallTool = async () => {
    isLoading.value = true;

    const res = (await callTool('update-weather-tool', {
        city: 'Denver',
    })) as any;

    isLoading.value = false;

    if (res?.isError) {
        throw new Error(
            'Error calling tool:',
            res?.error || 'Unknown error occurred',
        );
    }

    toolOutput.value = res?.structuredContent;
};

const onRequestDisplayMode = async () => {
    await requestDisplayMode('fullscreen');
};

const onGetWindowObject = () => {
    console.log(
        '%c✦ OpenAI Window API \n',
        'color: skyblue; font-size: 16px; font-weight: bold',
        window.openai,
    );
};
</script>

<template>
    <div>
        <div
            class="flex justify-between overflow-hidden rounded-md bg-white dark:bg-neutral-800"
            v-if="toolOutput"
        >
            <div class="flex w-full max-w-xs flex-col p-4">
                <template v-if="!isLoading">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-xl font-bold dark:text-gray-200">
                                {{ toolOutput.city }}
                            </div>
                            <div
                                class="text-sm text-gray-500 dark:text-gray-300"
                            >
                                {{ toolOutput.date }}
                            </div>
                        </div>
                    </div>
                    <div class="my-6 flex items-center justify-around">
                        <div
                            class="flex flex-col items-center justify-center gap-1 rounded-md bg-gray-100 p-1 font-bold dark:bg-neutral-700"
                        >
                            <button
                                @click="onUpdateState('f')"
                                :class="[
                                    'rounded-sm px-3 py-2 transition-colors',
                                    widgetState?.units === 'f' || !widgetState
                                        ? 'bg-white text-sky-500 dark:bg-neutral-800 dark:text-sky-300'
                                        : 'hover:bg-gray-200/75 dark:text-gray-300 dark:hover:bg-neutral-800/50',
                                ]"
                            >
                                F°
                            </button>
                            <button
                                @click="onUpdateState('c')"
                                :class="[
                                    'rounded-sm px-3 py-2 transition-colors',
                                    widgetState?.units === 'c'
                                        ? 'bg-white text-sky-500 dark:bg-neutral-800 dark:text-sky-400'
                                        : 'hover:bg-gray-200/75 dark:text-gray-300 dark:hover:bg-neutral-800/50',
                                ]"
                            >
                                C°
                            </button>
                        </div>
                        <div
                            class="inline-flex size-24 items-center justify-center self-center rounded-lg text-6xl text-sky-500 dark:text-sky-400"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.25 15a4.5 4.5 0 0 0 4.5 4.5H18a3.75 3.75 0 0 0 1.332-7.257 3 3 0 0 0-3.758-3.848 5.25 5.25 0 0 0-10.233 2.33A4.502 4.502 0 0 0 2.25 15Z"
                                />
                            </svg>
                        </div>
                    </div>
                    <div class="flex flex-row items-center justify-center">
                        <div class="text-6xl font-medium dark:text-gray-200">
                            {{ toolOutput.temp.current[unit] }}°
                        </div>
                        <div class="ml-6 flex flex-col items-center">
                            <div class="dark:text-gray-200">Cloudy</div>
                            <div
                                class="mt-1 flex items-center gap-px text-gray-500 dark:text-gray-300"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-3"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18"
                                    />
                                </svg>

                                <span class="text-sm font-light">
                                    {{ toolOutput.temp.high[unit] }}°
                                </span>
                            </div>
                            <div
                                class="flex items-center gap-px text-gray-500 dark:text-gray-300"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-3"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3"
                                    />
                                </svg>

                                <span
                                    class="text-sm font-light text-gray-500 dark:text-gray-300"
                                >
                                    {{ toolOutput.temp.low[unit] }}°
                                </span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="mt-6 flex flex-row justify-between"
                        v-if="toolOutput.conditions?.length"
                    >
                        <div
                            class="flex flex-1 flex-col items-center"
                            v-for="condition in toolOutput.conditions"
                            :key="condition.label"
                        >
                            <div class="text-sm font-medium dark:text-gray-200">
                                {{ condition.label }}
                            </div>
                            <div
                                class="text-sm text-gray-500 dark:text-gray-300"
                            >
                                {{ condition.value }}
                            </div>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div
                        class="text-medium flex h-full items-center justify-center gap-2 overflow-hidden rounded-md bg-white uppercase dark:bg-neutral-800 dark:text-gray-200"
                    >
                        <svg
                            class="size-5 animate-spin"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            ></circle>
                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                            ></path>
                        </svg>
                        <p>Refreshing weather widget...</p>
                    </div>
                </template>
            </div>
            <div class="flex flex-col justify-center gap-2 p-4">
                <button
                    @click="onSendFollowup"
                    class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 dark:bg-white/10 dark:text-white dark:shadow-none dark:inset-ring-white/5 dark:hover:bg-white/20"
                >
                    Follow Up
                </button>

                <button
                    @click="onOpenExternal"
                    class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 dark:bg-white/10 dark:text-white dark:shadow-none dark:inset-ring-white/5 dark:hover:bg-white/20"
                >
                    External
                </button>

                <button
                    @click="onCallTool"
                    class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 dark:bg-white/10 dark:text-white dark:shadow-none dark:inset-ring-white/5 dark:hover:bg-white/20"
                >
                    Call Tool
                </button>

                <button
                    @click="onRequestDisplayMode"
                    class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 dark:bg-white/10 dark:text-white dark:shadow-none dark:inset-ring-white/5 dark:hover:bg-white/20"
                >
                    Display Mode
                </button>

                <button
                    @click="onGetWindowObject"
                    class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 dark:bg-white/10 dark:text-white dark:shadow-none dark:inset-ring-white/5 dark:hover:bg-white/20"
                >
                    Get API
                </button>
            </div>
        </div>

        <div
            class="text-medium flex items-center justify-center gap-2 overflow-hidden rounded-md bg-white px-2 py-12 uppercase dark:bg-neutral-800 dark:text-gray-200"
            v-else
        >
            <svg
                class="size-5 animate-spin"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
            >
                <circle
                    class="opacity-25"
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="4"
                ></circle>
                <path
                    class="opacity-75"
                    fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                ></path>
            </svg>
            Loading weather widget...
        </div>
    </div>
</template>
