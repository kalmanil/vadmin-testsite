#!/usr/bin/env node

/**
 * Development server starter for vadmin-react-vite
 * This script helps ensure the Vite dev server is properly configured
 */

import { createServer } from 'vite'
import { readFileSync } from 'fs'
import { resolve } from 'path'

const __dirname = process.cwd()

async function startDevServer() {
  try {
    // Read the vite config
    const configPath = resolve(__dirname, 'vite.config.js')
    console.log('🚀 Starting Vite dev server for vadmin-react-vite...')
    console.log('📁 Working directory:', __dirname)
    console.log('⚙️  Config file:', configPath)
    
    // Create Vite server
    const server = await createServer({
      configFile: configPath,
      server: {
        host: 'localhost',
        port: 5178
      }
    })
    
    await server.listen()
    
    console.log('\n✅ Vite dev server started successfully!')
    console.log('🌐 Local:   http://localhost:5178/')
    console.log('🔗 Laravel: Add route to serve the vadmin-react-vite view')
    console.log('\n📝 Example Laravel route:')
    console.log(`Route::get('/admin-vite', function () {
    return view('vadmin-react-vite.index', [
        'siteName' => env('DOMAIN_SITE_TITLE', 'VAdmin'),
        'domain' => request()->getHost(),
        'app' => env('DOMAIN_APP_NAME', 'vadmin-testsite'),
        'themeColor' => env('DOMAIN_THEME_COLOR', '#0ea5e9')
    ]);
});`)
    
    console.log('\n🔄 Hot Module Replacement (HMR) enabled')
    console.log('💡 Edit files in js/src/ to see live updates')
    
  } catch (error) {
    console.error('❌ Failed to start dev server:', error.message)
    process.exit(1)
  }
}

startDevServer()
