import { useOpenAiGlobal } from "./useOpenAiGlobal";
import { type DisplayMode } from "@/types/openai";
import { type Ref } from "vue";

export const useDisplayMode = (): Ref<DisplayMode | null> => {
  return useOpenAiGlobal("displayMode");
};
