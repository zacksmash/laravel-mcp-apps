import { UserAgent } from '@mcp/types/openai';
import { Ref } from 'vue';
import { useOpenAiGlobal } from './useOpenAiGlobal';

export const useUserAgent = (): Ref<UserAgent | null> => {
    return useOpenAiGlobal('userAgent');
};
