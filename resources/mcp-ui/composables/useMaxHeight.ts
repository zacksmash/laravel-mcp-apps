import { useOpenAiGlobal } from "@mcp/composables/useOpenAiGlobal";

export const useMaxHeight = (): number | null => {
  return useOpenAiGlobal("maxHeight");
};
