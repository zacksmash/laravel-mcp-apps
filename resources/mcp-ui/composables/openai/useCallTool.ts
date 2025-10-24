import { CallTool, CallToolResponse } from '@mcp/types/openai';

export function useCallTool(): CallTool {
    const callTool: CallTool = async (name: string, args: Record<string, unknown>): Promise<CallToolResponse> => {
        try {
            const result = await window?.openai?.callTool(name, args);
            return result;
        } catch (err) {
            console.error('callTool failed', err);
            throw err;
        }
    };

    return callTool;
}
