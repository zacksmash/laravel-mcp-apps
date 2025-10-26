import { type Ref } from 'vue';
import { SafeArea } from '../types';
import { useOpenAiGlobal } from './useOpenAiGlobal';

export const useSafeArea = (): Ref<SafeArea | null> => {
    return useOpenAiGlobal('safeArea');
};
