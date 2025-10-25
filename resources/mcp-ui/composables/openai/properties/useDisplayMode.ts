import { type Ref } from 'vue';
import { DisplayMode } from '../types';
import { useOpenAiGlobal } from './useOpenAiGlobal';

export const useDisplayMode = (): Ref<DisplayMode | null> => {
    return useOpenAiGlobal('displayMode');
};
