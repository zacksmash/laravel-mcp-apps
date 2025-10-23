import { useOpenAiGlobal } from "@mcp/composables/useOpenAiGlobal";
import { Theme } from "@mcp/types/openai";

export const useTheme = (): Theme | null => {
  return useOpenAiGlobal("theme");
};
