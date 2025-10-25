import { Theme } from '@mcp/types/openai';
import { type Ref } from 'vue';
import { useOpenAiGlobal } from '../useOpenAiGlobal';

export const useTheme = (): Ref<Theme | null> => {
    return useOpenAiGlobal('theme');
};
