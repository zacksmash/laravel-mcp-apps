export function useSendFollowUpMessage() {
    const sendFollowUpMessage = async (args: { prompt: string }): Promise<void> => {
        await window.openai?.sendFollowUpMessage(args);
    };

    return sendFollowUpMessage;
}
