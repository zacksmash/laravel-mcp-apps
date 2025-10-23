import { SafeArea } from '@mcp/types/openai';
import { Ref } from 'vue';
import { useOpenAiGlobal } from './useOpenAiGlobal';

export const useSafeArea = (): Ref<SafeArea | null> => {
    return useOpenAiGlobal('safeArea');
};
