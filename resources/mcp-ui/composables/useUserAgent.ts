import { useOpenAiGlobal } from "@mcp/composables/useOpenAiGlobal";
import { UserAgent } from "@mcp/types/openai";

export const useUserAgent = (): UserAgent | null => {
  return useOpenAiGlobal("userAgent");
};
