import { computed, ref, readonly, onMounted, onUnmounted, type Ref } from "vue";
import {
    SET_GLOBALS_EVENT_TYPE,
    type SetGlobalsEvent,
    type OpenAiGlobals,
} from "@/types/openai";

export function useOpenAiGlobal<K extends keyof OpenAiGlobals>(
    key: K
): Readonly<Ref<OpenAiGlobals[K] | null>> {
    const state = ref<OpenAiGlobals[K] | null>(null);

    const onChange = () => {
        state.value = typeof window !== "undefined" ? window.openai?.[key] ?? null : null;
    };

    let handleSetGlobal: ((e: SetGlobalsEvent) => void) | null = null;

    onMounted(() => {
        onChange();

        handleSetGlobal = (event: SetGlobalsEvent) => {
            const value = event.detail?.globals?.[key];
            if (value === undefined) return;

            onChange();
        };

        window.addEventListener(SET_GLOBALS_EVENT_TYPE, handleSetGlobal, { passive: true });
    });

    onUnmounted(() => {
        if (handleSetGlobal) {
            window.removeEventListener(SET_GLOBALS_EVENT_TYPE, handleSetGlobal);
            handleSetGlobal = null;
        }
    });

    const bound = computed(() => {
        const v = state.value as unknown;
        if (
            typeof v === "function" &&
            typeof window !== "undefined" &&
            window.openai
        ) {
            return (v as Function).bind(window.openai) as unknown as OpenAiGlobals[K];
        }
        return state.value;
    });

    return readonly(bound) as Readonly<Ref<OpenAiGlobals[K] | null>>;
}
