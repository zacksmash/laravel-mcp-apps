import { DisplayMode } from "@mcp/types/openai";
import { useOpenAiGlobal } from "@mcp/composables/useOpenAiGlobal";

export const useDisplayMode = (): DisplayMode | null => {
  return useOpenAiGlobal("displayMode");
};
