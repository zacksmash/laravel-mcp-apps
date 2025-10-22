import { ref, onMounted, onBeforeUnmount, type Ref } from 'vue'
import { SET_GLOBALS_EVENT_TYPE, type UnknownObject, type SetGlobalsEvent } from '@mcp/types/openai'

export function useWidgetState() {
  const widgetState: Ref<UnknownObject | null> = ref<UnknownObject | null>(null)
  let handler: ((e: SetGlobalsEvent) => void) | null = null

  const read = () => {
    if (typeof window !== 'undefined' && window.openai) {
      widgetState.value = window.openai.widgetState as UnknownObject | null
    }
  }

  async function setWidgetState(
    next: UnknownObject | ((prev: UnknownObject | null) => UnknownObject)
  ): Promise<void> {
    if (typeof window === 'undefined' || !window.openai?.setWidgetState) return

    const nextValue =
      typeof next === 'function' ? (next as (p: UnknownObject | null) => UnknownObject)(widgetState.value) : next

    widgetState.value = nextValue
    try {
      await window.openai.setWidgetState(nextValue as UnknownObject)
    } catch (err) {
      console.error('setWidgetState failed', err)
    }
  }

  onMounted(() => {
    if (typeof window === 'undefined') return
    read()

    handler = (e: SetGlobalsEvent) => {
      const globals = e.detail?.globals
      if (globals && 'widgetState' in globals) {
        widgetState.value = globals.widgetState as UnknownObject | null
      }
    }

    window.addEventListener(SET_GLOBALS_EVENT_TYPE, handler as EventListener)
  })

  onBeforeUnmount(() => {
    if (typeof window === 'undefined' || !handler) return
    window.removeEventListener(SET_GLOBALS_EVENT_TYPE, handler as EventListener)
    handler = null
  })

  return { widgetState, setWidgetState }
}
