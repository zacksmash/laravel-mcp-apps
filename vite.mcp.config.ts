import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import vueDevTools from 'vite-plugin-vue-devtools';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        vueDevTools({
            appendTo: 'app.ts'
        }),
        laravel({
            input: ['resources/mcp-ui/js/app.ts'],
            buildDirectory: 'build/mcp',
            refresh: true,
        }),
        tailwindcss(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],

    build: {
        outDir: 'public/build/mcp',
        emptyOutDir: true,
        minify: true,
        copyPublicDir: false,
        rollupOptions: {
            input: 'resources/mcp-ui/js/app.ts',
            output: {
                format: 'es',
                entryFileNames: 'app-[hash].js',
                assetFileNames: 'app-[hash].css',
            },
        },
    },

    resolve: {
        alias: {
            '@mcp': '/resources/mcp-ui/js',
        },
    },
});
