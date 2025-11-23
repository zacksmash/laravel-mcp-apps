import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';
import vueDevTools from 'vite-plugin-vue-devtools';

export default defineConfig({
    plugins: [
        vueDevTools({
            appendTo: 'main.ts',
        }),
        laravel({
            input: ['resources/mcp/main.ts'],
            refresh: true,
            hotFile: 'public/hot-mcp',
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
            input: 'resources/mcp/main.ts',
            output: {
                format: 'es',
                entryFileNames: 'app-[hash].js',
                assetFileNames: 'app-[hash].css',
            },
        },
    },

    resolve: {
        alias: {
            '@mcp': '/resources/mcp',
        },
    },
});
