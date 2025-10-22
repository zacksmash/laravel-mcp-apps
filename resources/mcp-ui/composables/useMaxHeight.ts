import { useOpenAiGlobal } from "@mcp/composables/useOpenAiGlobal";
import { type Ref } from "vue";

export const useMaxHeight = (): Ref<number | null> => {
  return useOpenAiGlobal("maxHeight");
};
