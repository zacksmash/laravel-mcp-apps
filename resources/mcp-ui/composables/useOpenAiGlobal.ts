import { ref, readonly, onMounted, onUnmounted, type Ref } from "vue";
import {
    SET_GLOBALS_EVENT_TYPE,
    SetGlobalsEvent,
    type OpenAiGlobals,
} from "@mcp/types/openai";

export function useOpenAiGlobal<K extends keyof OpenAiGlobals>(
    key: K
): Ref<OpenAiGlobals[K] | null> {
    const state = ref<OpenAiGlobals[K] | null>(null);

    const onChange = () => {
        state.value = typeof window !== "undefined" ? window.openai?.[key] ?? null : null;
    };

    let handleSetGlobal: ((e: SetGlobalsEvent) => void) | null = null;

    onMounted(() => {
        onChange();

        handleSetGlobal = (event: SetGlobalsEvent) => {
            console.log('here');

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

    return readonly(state) as Readonly<Ref<OpenAiGlobals[K] | null>>;
}
