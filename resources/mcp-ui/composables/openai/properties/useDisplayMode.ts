import { DisplayMode } from '@mcp/types/openai';
import { type Ref } from 'vue';
import { useOpenAiGlobal } from '../useOpenAiGlobal';

export const useDisplayMode = (): Ref<DisplayMode | null> => {
    return useOpenAiGlobal('displayMode');
};
