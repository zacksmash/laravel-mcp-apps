import { useOpenAiGlobal } from "@mcp/composables/useOpenAiGlobal";
import { SafeArea } from "@mcp/types/openai";

export const useSafeArea = (): SafeArea | null => {
  return useOpenAiGlobal("safeArea");
};
