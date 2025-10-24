import { type OpenAiGlobals, type UnknownObject } from '@mcp/types/openai';
import { Ref } from 'vue';
import { useOpenAiGlobal } from './useOpenAiGlobal';

export function useWidgetState<T extends OpenAiGlobals['widgetState']>() {
    const widgetState = useOpenAiGlobal('widgetState') as Ref<T | null>;

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

    return { widgetState, setWidgetState } as {
        widgetState: typeof widgetState;
        setWidgetState: typeof setWidgetState;
    };
}
