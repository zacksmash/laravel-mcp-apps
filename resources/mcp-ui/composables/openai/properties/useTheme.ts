import { type Ref } from 'vue';
import { Theme } from '../types';
import { useOpenAiGlobal } from '../useOpenAiGlobal';

export const useTheme = (): Ref<Theme | null> => {
    return useOpenAiGlobal('theme');
};
