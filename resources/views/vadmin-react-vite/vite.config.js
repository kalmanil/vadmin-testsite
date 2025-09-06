import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import { resolve } from 'path'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [react()],
  root: '.',
  build: {
    outDir: './dist',
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: './js/src/main.jsx'
    },
    assetsDir: 'assets'
  },
  server: {
    host: 'localhost',
    port: 5174,
    cors: true,
    hmr: {
      host: 'localhost',
      port: 5174
    },
    // Allow access from Laravel app
    origin: 'http://localhost:5174'
  },
  resolve: {
    alias: {
      '@': resolve(__dirname, './js/src'),
      '@components': resolve(__dirname, './js/src/components'),
      '@hooks': resolve(__dirname, './js/src/hooks'),
      '@utils': resolve(__dirname, './js/src/utils'),
      '@styles': resolve(__dirname, './js/src/styles')
    }
  },
  publicDir: './public',
  base: process.env.NODE_ENV === 'production' ? '/vadmin-react-vite/' : '/',
  // Ensure CSS is extracted in production
  css: {
    devSourcemap: true
  }
})
