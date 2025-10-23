import { SafeArea } from '@mcp/types/openai';
import { useOpenAiGlobal } from './useOpenAiGlobal';

export const useSafeArea = (): SafeArea | null => {
    return useOpenAiGlobal('safeArea');
};
