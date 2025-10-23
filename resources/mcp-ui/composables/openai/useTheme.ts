import { Theme } from '@mcp/types/openai';
import { useOpenAiGlobal } from './useOpenAiGlobal';

export const useTheme = (): Theme | null => {
    return useOpenAiGlobal('theme');
};
