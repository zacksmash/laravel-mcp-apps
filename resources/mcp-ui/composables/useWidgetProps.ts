import { useOpenAiGlobal } from "@mcp/composables/useOpenAiGlobal";
import { ref } from "vue";

export function useWidgetProps<T extends Record<string, unknown>>(
  defaultState?: T | (() => T)
): T {
  const props = useOpenAiGlobal("toolOutput") as T;

  const fallback =
    typeof defaultState === "function"
      ? (defaultState as () => T | null)()
      : defaultState ?? null;

  return props.value ? props : ref(fallback) as T;
}
