import { useOpenAiGlobal } from "@mcp/composables/useOpenAiGlobal";

export const useWidgetParams = <T extends Record<string, unknown>>() => {
  return useOpenAiGlobal("toolInput") as T;
};
