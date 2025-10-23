import { useOpenAiGlobal } from './useOpenAiGlobal';

export const useWidgetParams = <T extends Record<string, unknown>>() => {
    return useOpenAiGlobal('toolInput') as T;
};
