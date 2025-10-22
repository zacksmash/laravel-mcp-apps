import { useOpenAiGlobal } from "@mcp/composables/useOpenAiGlobal";
import { type DisplayMode } from "@mcp/types/openai";
import { type Ref } from "vue";

export const useDisplayMode = (): Ref<DisplayMode | null> => {
  return useOpenAiGlobal("displayMode");
};
