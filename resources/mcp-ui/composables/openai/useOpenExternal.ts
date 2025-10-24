export function useOpenExternal() {
    const openExternal = (payload: { href: string }): void => {
        window.openai?.openExternal(payload);
    };

    return openExternal;
}
