import PerformanceView from '@mcp/pages/PerformanceView.vue'

export function useComponent(name: string) {
    const components: Record<string, any> = {
        'performance': PerformanceView
    }

    return components[name]
}
