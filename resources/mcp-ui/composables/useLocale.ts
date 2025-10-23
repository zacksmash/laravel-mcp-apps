import { useOpenAiGlobal } from "@mcp/composables/useOpenAiGlobal";

export const useLocale = (): string | null => {
  return useOpenAiGlobal("locale");
};
