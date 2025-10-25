import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react'
import path from 'path'

export default defineConfig({
  plugins: [react({
    // Enable CSS HMR
    fastRefresh: true
  })],
  root: path.resolve(__dirname, '.'),
  css: {
    devSourcemap: true
  },
  server: {
    port: 5178,
    strictPort: true,
    host: '0.0.0.0',  // Listen on all interfaces for WSL
    cors: true,
    origin: '*',
    allowedHosts: ['localhost', '.test', '.local', 'all'],
    hmr: {
      port: 5178,
      host: 'localhost',
      protocol: 'ws',
      clientPort: 5178
    },
    watch: {
      usePolling: true,   // Enable polling for WSL file system
      interval: 100
    }
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
    outDir: path.resolve(__dirname, 'dist'), // Build to local dist directory
    emptyOutDir: true,
    manifest: 'manifest.json', // Output manifest in dist root
    rollupOptions: {
      input: path.resolve(__dirname, 'index.html'),
    },
  },
  publicDir: 'public', // Specify public directory separately
})