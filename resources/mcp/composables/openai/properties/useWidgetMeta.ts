import { type Ref, ref } from 'vue';
import { useOpenAiGlobal } from './useOpenAiGlobal';

export function useWidgetMeta<T extends Ref<Record<string, unknown>>>(
    defaultState?: Record<string, unknown> | (() => Record<string, unknown>),
): T {
    const meta = useOpenAiGlobal('toolResponseMetadata') as T;

    const fallback =
        typeof defaultState === 'function'
            ? (defaultState as () => T | null)()
            : (defaultState ?? null);

    return meta.value ? meta : (ref(fallback) as T);
}
