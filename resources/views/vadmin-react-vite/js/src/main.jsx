import React from 'react'
import ReactDOM from 'react-dom/client'
import App from '@/App.jsx'
import '@styles/index.css'

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
