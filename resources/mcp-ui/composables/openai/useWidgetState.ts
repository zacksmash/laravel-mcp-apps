import { SET_GLOBALS_EVENT_TYPE, SetGlobalsEvent, type OpenAiGlobals, type UnknownObject } from '@mcp/types/openai';
import { onBeforeUnmount, onMounted, ref } from 'vue';

export function useWidgetState<T extends OpenAiGlobals['widgetState']>() {
    const widgetState = ref((window.openai as OpenAiGlobals)['widgetState'] as T | null);

    const onChange = () => {
        if (typeof window !== 'undefined' && window.openai) {
            widgetState.value = window.openai.widgetState as T | null;
        }
    };

    let handleSetGlobal: ((e: SetGlobalsEvent) => void) | null = null;

    async function setWidgetState(next: T | ((prev: T | null) => T)): Promise<void> {
        if (typeof window === 'undefined' || !window.openai?.setWidgetState) return;

        const nextValue = typeof next === 'function' ? (next as (p: T | null) => T)(widgetState.value) : next;

        widgetState.value = nextValue;

        try {
            await window.openai.setWidgetState(nextValue as UnknownObject);
        } catch (err) {
            console.error('setWidgetState failed', err);
        }
    }

    onMounted(() => {
        if (typeof window === 'undefined') return;

        onChange();

        handleSetGlobal = (event: SetGlobalsEvent) => {
            const globals = event.detail?.globals;
            if (globals && 'widgetState' in globals) {
                widgetState.value = globals.widgetState as T | null;
            }
        };

        window.addEventListener(SET_GLOBALS_EVENT_TYPE, handleSetGlobal, {
            passive: true,
        });
    });

    onBeforeUnmount(() => {
        if (typeof window === 'undefined' || !handleSetGlobal) return;
        window.removeEventListener(SET_GLOBALS_EVENT_TYPE, handleSetGlobal);
        handleSetGlobal = null;
    });

    return { widgetState, setWidgetState } as {
        widgetState: typeof widgetState;
        setWidgetState: typeof setWidgetState;
    };
}
