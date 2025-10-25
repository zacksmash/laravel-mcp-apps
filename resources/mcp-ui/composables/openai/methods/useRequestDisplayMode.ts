import { DisplayMode } from '@mcp/types/openai';

export function useRequestDisplayMode() {
    const requestDisplayMode = async (mode: DisplayMode): Promise<void> => {
        await window.openai?.requestDisplayMode({ mode });
    };

    return requestDisplayMode;
}
