import React, { useState, useEffect } from 'react'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import Layout from '@components/Layout'
import Dashboard from '@components/Dashboard'
import Settings from '@components/Settings'
import { useConfig } from '@hooks/useConfig'
import ErrorBoundary from '@components/ErrorBoundary'

function App() {
  const config = useConfig()
  const [isLoading, setIsLoading] = useState(true)
  const [theme, setTheme] = useState('light')

  useEffect(() => {
    // Initialize app
    const initApp = async () => {
      try {
        // Simulate initialization delay
        await new Promise(resolve => setTimeout(resolve, 1000))
        
        // Check for saved theme preference
        const savedTheme = localStorage.getItem('vadmin-theme') || 'light'
        setTheme(savedTheme)
        
        // Apply theme to document
        document.documentElement.classList.toggle('dark', savedTheme === 'dark')
        
        setIsLoading(false)
      } catch (error) {
        console.error('Failed to initialize app:', error)
        setIsLoading(false)
      }
    }

    initApp()
  }, [])

  const toggleTheme = () => {
    const newTheme = theme === 'light' ? 'dark' : 'light'
    setTheme(newTheme)
    localStorage.setItem('vadmin-theme', newTheme)
    document.documentElement.classList.toggle('dark', newTheme === 'dark')
  }

  if (isLoading) {
    return (
      <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center">
        <div className="text-center">
          <div className="relative mb-6">
            <div className="animate-spin rounded-full h-16 w-16 border-4 border-blue-200 border-t-blue-600 mx-auto"></div>
            <div className="absolute inset-0 flex items-center justify-center">
              <div className="text-2xl">🚍</div>
            </div>
          </div>
          <h2 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
            {config.siteName}
          </h2>
          <p className="text-gray-600 dark:text-gray-400">
            Initializing modern admin interface...
          </p>
        </div>
      </div>
    )
  }

  return (
    <ErrorBoundary>
      <Router basename="/admin-vite">
        <div className="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
          <Layout theme={theme} onThemeToggle={toggleTheme}>
            <Routes>
              <Route path="/" element={<Dashboard />} />
              <Route path="/settings" element={<Settings />} />
              <Route path="*" element={<Dashboard />} />
            </Routes>
          </Layout>
        </div>
      </Router>
    </ErrorBoundary>
  )
}

export default App
