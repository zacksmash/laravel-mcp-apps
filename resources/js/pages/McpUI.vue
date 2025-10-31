<script setup>
// send a message from the iframe to the parent window
const sendMessage = () => {
    window.parent.postMessage({
        type: 'notify',
        payload: {
            message: 'This is a test of the notification system.',
        }
    }, '*');
}
</script>

<template>
    <div class="bg-white dark:bg-gray-900">
      <div class="mx-auto max-w-7xl p-4">
        <div class="relative isolate overflow-hidden bg-gray-900 px-6 py-24 text-center shadow-2xl sm:rounded-3xl sm:px-16 dark:bg-gray-800 dark:shadow-none dark:after:pointer-events-none dark:after:absolute dark:after:inset-0 dark:after:inset-ring dark:after:inset-ring-white/10 dark:after:sm:rounded-3xl">
          <h2 class="text-4xl font-semibold tracking-tight text-balance text-white sm:text-5xl">MCP-UI</h2>
          <p class="mx-auto mt-6 max-w-xl text-lg/8 text-pretty text-gray-300">
            This is an example MCPUI page served from a tool response. Click the button below to send a message to the parent window.
        </p>
          <div class="mt-10 flex items-center justify-center gap-x-6">
            <button href="#" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-xs hover:bg-gray-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white dark:bg-white/10 dark:text-white dark:shadow-none dark:inset-ring dark:inset-ring-white/5 dark:hover:bg-white/15 dark:focus-visible:outline-white" @click="sendMessage">
                Send MCP-UI Event
            </button>
          </div>
          <svg viewBox="0 0 1024 1024" class="absolute top-1/2 left-1/2 -z-10 size-256 -translate-x-1/2 mask-[radial-gradient(closest-side,white,transparent)]" aria-hidden="true">
            <circle cx="512" cy="512" r="512" fill="url(#827591b1-ce8c-4110-b064-7cb85a0b1217)" fill-opacity="0.7" />
            <defs>
              <radialGradient id="827591b1-ce8c-4110-b064-7cb85a0b1217">
                <stop stop-color="#7775D6" />
                <stop offset="1" stop-color="#E935C1" />
              </radialGradient>
            </defs>
          </svg>
        </div>
      </div>
    </div>
</template>
