import { type Ref } from 'vue';
import { UserAgent } from '../types';
import { useOpenAiGlobal } from './useOpenAiGlobal';

export const useUserAgent = (): Ref<UserAgent | null> => {
    return useOpenAiGlobal('userAgent');
};
