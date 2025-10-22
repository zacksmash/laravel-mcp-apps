import { useOpenAiGlobal } from "./useOpenAiGlobal";
import { type Ref } from "vue";

export function useWidgetProps<T extends Ref<Record<string, unknown>>>(
  defaultState?: T | (() => T)
): T {
  const props = useOpenAiGlobal("toolOutput") as T;

  const fallback =
    typeof defaultState === "function"
      ? (defaultState as () => T | null)()
      : defaultState ?? null;

  return props ?? fallback;
}
