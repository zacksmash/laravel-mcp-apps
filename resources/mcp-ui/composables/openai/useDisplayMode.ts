import { DisplayMode } from '@mcp/types/openai';
import { useOpenAiGlobal } from './useOpenAiGlobal';

export const useDisplayMode = (): DisplayMode | null => {
    return useOpenAiGlobal('displayMode');
};
