import { UserAgent } from '@mcp/types/openai';
import { type Ref } from 'vue';
import { useOpenAiGlobal } from '../useOpenAiGlobal';

export const useUserAgent = (): Ref<UserAgent | null> => {
    return useOpenAiGlobal('userAgent');
};
