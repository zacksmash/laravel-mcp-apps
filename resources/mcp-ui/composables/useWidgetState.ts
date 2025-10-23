import { ref, onMounted, onBeforeUnmount, type Ref } from 'vue'
import { SET_GLOBALS_EVENT_TYPE, type UnknownObject, type SetGlobalsEvent } from '@mcp/types/openai'

export function useWidgetState<T extends UnknownObject = UnknownObject>() {
  const widgetState = ref(null) as Ref<T | null>
  let handler: ((e: SetGlobalsEvent) => void) | null = null

  const read = () => {
    if (typeof window !== 'undefined' && window.openai) {
      widgetState.value = window.openai.widgetState as T | null
    }
  }

  async function setWidgetState(
    next: T | ((prev: T | null) => T)
  ): Promise<void> {
    if (typeof window === 'undefined' || !window.openai?.setWidgetState) return

    const nextValue =
      typeof next === 'function' ? (next as (p: T | null) => T)(widgetState.value) : next

    widgetState.value = nextValue
    try {
      // Cast because openai global typing is generic and we pass concrete shape here.
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
        widgetState.value = globals.widgetState as T | null
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
