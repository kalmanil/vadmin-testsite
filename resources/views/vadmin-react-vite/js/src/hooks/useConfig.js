import { useMemo } from 'react'

/**
 * Hook to access global configuration from Laravel
 * Configuration is injected via window.__VADMIN_CONFIG__
 */
export function useConfig() {
  const config = useMemo(() => {
    if (typeof window !== 'undefined' && window.__VADMIN_CONFIG__) {
      return window.__VADMIN_CONFIG__
    }
    
    // Fallback configuration for development
    return {
      siteName: 'VAdmin',
      domain: 'localhost',
      app: 'vadmin-testsite',
      themeColor: '#0ea5e9',
      apiBase: '/api',
      csrfToken: '',
      user: null,
      environment: 'local',
      routes: {
        home: '/',
        about: '/about'
      }
    }
  }, [])

  return config
}

/**
 * Hook to get API configuration with CSRF token
 */
export function useApiConfig() {
  const config = useConfig()
  
  return useMemo(() => ({
    baseURL: config.apiBase,
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': config.csrfToken,
      'Accept': 'application/json'
    }
  }), [config.apiBase, config.csrfToken])
}
