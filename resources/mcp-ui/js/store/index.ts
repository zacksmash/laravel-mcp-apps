import { defineStore } from 'pinia'

export const useAppStore = defineStore('app', {
    state: () => {
        return {
            global: false,
        }
    },
    actions: {
        setGlobal(value: any) {
            this.global = value;
        }
    }
})
