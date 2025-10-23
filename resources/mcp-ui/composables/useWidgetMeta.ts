import { useOpenAiGlobal } from "@mcp/composables/useOpenAiGlobal";
import { ref } from "vue";

export function useWidgetMeta<T extends Record<string, unknown>>(
  defaultState?: T | (() => T)
): T {
  const meta = useOpenAiGlobal("toolResponseMetadata") as T;

  const fallback =
    typeof defaultState === "function"
      ? (defaultState as () => T | null)()
      : defaultState ?? null;

  return meta.value ? meta : ref(fallback) as T;
}
