import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react'
import path from 'path'

export default defineConfig({
  plugins: [react()],
  server: {
    port: 5178,
    strictPort: true,
    host: true,
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './js/src'),
      '@components': path.resolve(__dirname, './js/src/components'),
      '@hooks': path.resolve(__dirname, './js/src/hooks'),
      '@styles': path.resolve(__dirname, './js/src/styles')
    }
  },
  build: {
    outDir: 'public/vadmin-react-vite/dist', // match Blade path
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: 'js/src/main.jsx', // 👈 fixed path
    },
  },
})