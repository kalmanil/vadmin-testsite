import React from 'react'
import ReactDOM from 'react-dom/client'
import App from '@/App.jsx'
import '@styles/index.css'

// Enable HMR
if (import.meta.hot) {
  console.log('🔥 HMR is available')
  import.meta.hot.accept()
  
  // Listen for CSS updates via Vite's built-in CSS HMR
  import.meta.hot.on('vite:beforeUpdate', () => {
    console.log('🔄 Vite update starting...')
  })
  
  import.meta.hot.on('vite:afterUpdate', () => {
    console.log('✅ Vite update complete')
  })
  
  // CSS HMR is handled automatically by Vite
  console.log('🎨 CSS HMR is handled automatically by Vite')
} else {
  console.log('❌ HMR not available')
}

// Global error handler
window.addEventListener('error', (event) => {
  console.error('Global error:', event.error)
})

window.addEventListener('unhandledrejection', (event) => {
  console.error('Unhandled promise rejection:', event.reason)
})

// Initialize React app
const root = ReactDOM.createRoot(document.getElementById('vadmin-root'))

root.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
)
