import { User } from '@mcp/types';
import { defineStore } from 'pinia';

export const useAppStore = defineStore('app', {
    state: () => ({
        user: null as User | null,
    }),
    actions: {
        setUser(user: User) {
            this.user = user;
        },
    },
});
