import { useOpenAiGlobal } from './useOpenAiGlobal';

export const useLocale = (): string | null => {
    return useOpenAiGlobal('locale');
};
