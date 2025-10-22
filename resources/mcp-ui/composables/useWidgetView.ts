import PerformanceView from '@mcp/views/PerformanceView.vue'

export function useWidgetView(name: string) {
    const components: Record<string, any> = {
        'performance': PerformanceView
    }

    return components[name]
}
