import { UserAgent } from '@mcp/types/openai';
import { useOpenAiGlobal } from './useOpenAiGlobal';

export const useUserAgent = (): UserAgent | null => {
    return useOpenAiGlobal('userAgent');
};
