import { useOpenAiGlobal } from "@mcp/composables/useOpenAiGlobal";
import { UnknownObject } from "@mcp/types/openai";
import { type Ref, ref } from "vue";

export const useWidgetMeta = (defaults: UnknownObject | null): Ref<UnknownObject | null> => {
    const meta = useOpenAiGlobal("toolResponseMetadata");

    return meta?.value ? meta : ref(defaults);
};
