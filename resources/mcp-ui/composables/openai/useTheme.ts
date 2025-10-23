import { Theme } from '@mcp/types/openai';
import { Ref } from 'vue';
import { useOpenAiGlobal } from './useOpenAiGlobal';

export const useTheme = (): Ref<Theme | null> => {
    return useOpenAiGlobal('theme');
};
