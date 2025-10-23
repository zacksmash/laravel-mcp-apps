import { defineStore } from 'pinia'
import { User } from '@mcp/types'

export const useAppStore = defineStore('app', {
    state: () => ({
        user: null as User | null,
    }),
    actions: {
        setUser(user: User) {
            this.user = user;
        },
    },
})
