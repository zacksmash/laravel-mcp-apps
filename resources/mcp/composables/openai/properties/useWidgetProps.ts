import { type Ref, ref } from 'vue';
import { useOpenAiGlobal } from './useOpenAiGlobal';

export function useWidgetProps<T extends Ref<Record<string, unknown>>>(
    defaultState?: Record<string, unknown> | (() => Record<string, unknown>),
): T {
    const props = useOpenAiGlobal('toolOutput') as T;

    const fallback =
        typeof defaultState === 'function'
            ? (defaultState as () => T | null)()
            : (defaultState ?? null);

    return props.value ? props : (ref(fallback) as T);
}
