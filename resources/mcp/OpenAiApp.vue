<script setup lang="ts">
import { OpenAiProvider } from '@zacksmash/vue-open-ai-apps';
import App from '@mcp/views/App.vue';
</script>

<template>
  <OpenAiProvider>
    <!-- loading slot -->
    <template #loading>
      <div class="flex flex-col items-center justify-center py-4 gap-3">
        <p class="text-sm">Connecting to OpenAI Apps SDK</p>

        <svg class="size-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
      </div>
    </template>

    <!-- default slot for your app -->
    <App />

    <!-- error slot with props -->
    <template #error="{ message, retry }">
      <div class="p-4 text-center">
        <p class="text-red-500 font-semibold mb-2 text-sm">
          OpenAI Apps SDK failed: {{ message }}
        </p>

        <button @click="retry" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">
          Retry
        </button>
      </div>
    </template>
  </OpenAiProvider>
</template>
