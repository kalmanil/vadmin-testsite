<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteName }} - Modern Admin</title>
    <meta name="description" content="Modern React + Vite admin interface for {{ $siteName }}">

    <script type="module">
        import RefreshRuntime from 'http://localhost:5178/@react-refresh'
        RefreshRuntime.injectIntoGlobalHook(window)
        window.$RefreshReg$ = () => {}
        window.$RefreshSig$ = () => (type) => type
        window.__vite_plugin_react_preamble_installed__ = true
    </script>
    
    {{-- Global configuration for React app --}}
    <script>
        window.__VADMIN_CONFIG__ = {
            siteName: @json($siteName),
            domain: @json($domain),
            app: @json($app),
            themeColor: @json($themeColor),
            apiBase: @json(url('/api')),
            csrfToken: @json(csrf_token()),
            user: @json(auth()->user() ?? null),
            environment: @json(app()->environment()),
            routes: {
                home: @json(url('/')),
                about: @json(url('/about'))
            }
        };
    </script>
    
    {{-- Basic styling for loading and fallback --}}
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            background: #f9fafb;
            color: #111827;
        }
        .loading-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
        }
        .loading-card {
            text-align: center;
            background: white;
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            max-width: 28rem;
            width: 100%;
        }
        .spinner {
            width: 4rem;
            height: 4rem;
            border: 4px solid #dbeafe;
            border-top-color: #2563eb;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1.5rem;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .loading-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #111827;
        }
        .loading-subtitle {
            color: #6b7280;
            margin-bottom: 1rem;
        }
        .loading-dots {
            display: flex;
            justify-content: center;
            gap: 0.25rem;
        }
        .loading-dot {
            width: 0.5rem;
            height: 0.5rem;
            background: #2563eb;
            border-radius: 50%;
            animation: bounce 1.4s infinite ease-in-out both;
        }
        .loading-dot:nth-child(1) { animation-delay: -0.32s; }
        .loading-dot:nth-child(2) { animation-delay: -0.16s; }
        @keyframes bounce {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <div id="vadmin-root">
        {{-- Loading fallback --}}
        <div class="loading-container">
            <div class="loading-card">
                <div class="spinner"></div>
                <h1 class="loading-title">{{ $siteName }}</h1>
                <p class="loading-subtitle">Loading modern admin interface...</p>
                <div class="loading-dots">
                    <div class="loading-dot"></div>
                    <div class="loading-dot"></div>
                    <div class="loading-dot"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Load assets based on environment without using any Laravel Vite helpers --}}
    <script>
        // Configuration
        const isLocal = @json(app()->environment('local'));
        const vitePort = 5178;
        const viteDevServer = window.location.protocol + '//' + window.location.hostname + ':' + vitePort;
        const viteClientPath = '/' + '@' + 'vite/client';
        
        if (isLocal) {
            // Development mode: Check if Vite dev server is available
            fetch(viteDevServer + viteClientPath)
                .then(response => {
                    if (response.ok) {
                        // Vite server is running, load development assets
                        const viteClient = document.createElement('script');
                        viteClient.type = 'module';
                        viteClient.src = viteDevServer + viteClientPath;
                        document.head.appendChild(viteClient);
                        
                        const mainScript = document.createElement('script');
                        mainScript.type = 'module';
                        mainScript.src = viteDevServer + '/js/src/main.jsx';
                        document.head.appendChild(mainScript);
                        
                        console.log('✅ VAdmin React Vite: Development mode loaded');
                    } else {
                        throw new Error('Vite server not available');
                    }
                })
                .catch(() => {
                    // Vite server not running, show development instructions
                    console.warn('🚀 VAdmin React Vite: Dev server not running on localhost:' + vitePort);
                    showDevInstructions();
                });
        } else {
            // Production mode: Try to load built assets
            fetch('/vadmin-react-vite/dist/.vite/manifest.json')
                .then(response => response.json())
                .then(manifest => {
                    const entrypoint = manifest['js/src/main.jsx'];
                    if (entrypoint) {
                        // Load CSS files
                        if (entrypoint.css) {
                            entrypoint.css.forEach(cssFile => {
                                const link = document.createElement('link');
                                link.rel = 'stylesheet';
                                link.href = '/vadmin-react-vite/dist/' + cssFile;
                                document.head.appendChild(link);
                            });
                        }
                        
                        // Load JS file
                        const script = document.createElement('script');
                        script.type = 'module';
                        script.src = '/vadmin-react-vite/dist/' + entrypoint.file;
                        document.head.appendChild(script);
                        
                        console.log('✅ VAdmin React Vite: Production mode loaded');
                    }
                })
                .catch(() => {
                    console.warn('🏗️ VAdmin React Vite: No built assets found');
                    showBuildInstructions();
                });
        }
        
        function showDevInstructions() {
            document.getElementById('vadmin-root').innerHTML = `
                <div style="display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 2rem; font-family: system-ui, sans-serif; background: #f9fafb;">
                    <div style="text-align: center; background: white; padding: 3rem; border-radius: 1rem; box-shadow: 0 10px 25px rgba(0,0,0,0.1); max-width: 600px; border: 1px solid #e5e7eb;">
                        <div style="font-size: 4rem; margin-bottom: 1rem;">🚀</div>
                        <h1 style="color: #1f2937; margin-bottom: 1rem; font-size: 2rem;">Development Mode</h1>
                        <p style="color: #6b7280; margin-bottom: 2rem; line-height: 1.6;">Start the Vite development server to use the React admin interface.</p>
                        <div style="background: #f3f4f6; padding: 1.5rem; border-radius: 0.75rem; font-family: 'Courier New', monospace; text-align: left; margin-bottom: 2rem; border: 1px solid #d1d5db;">
                            <div style="margin-bottom: 0.5rem;"><strong>cd resources/views/vadmin-react-vite</strong></div>
                            <div style="margin-bottom: 0.5rem;"><strong>npm install</strong></div>
                            <div><strong>npm run dev</strong></div>
                        </div>
                        <p style="color: #6b7280; font-size: 0.9rem; background: #ecfdf5; padding: 1rem; border-radius: 0.5rem; border: 1px solid #a7f3d0;">
                            ✅ <strong>Server will start on:</strong> <code>http://localhost:' + vitePort + '</code><br>
                            Then refresh this page to load the React app
                        </p>
                    </div>
                </div>
            `;
        }
        
        function showBuildInstructions() {
            document.getElementById('vadmin-root').innerHTML = `
                <div style="display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 2rem; font-family: system-ui, sans-serif; background: #f9fafb;">
                    <div style="text-align: center; background: white; padding: 3rem; border-radius: 1rem; box-shadow: 0 10px 25px rgba(0,0,0,0.1); max-width: 600px; border: 1px solid #e5e7eb;">
                        <div style="font-size: 4rem; margin-bottom: 1rem;">🏗️</div>
                        <h1 style="color: #1f2937; margin-bottom: 1rem; font-size: 2rem;">Build Required</h1>
                        <p style="color: #6b7280; margin-bottom: 2rem; line-height: 1.6;">VAdmin React Vite needs to be built for production mode.</p>
                        <div style="background: #f3f4f6; padding: 1.5rem; border-radius: 0.75rem; font-family: 'Courier New', monospace; text-align: left; margin-bottom: 2rem; border: 1px solid #d1d5db;">
                            <div style="margin-bottom: 0.5rem;"><strong>cd resources/views/vadmin-react-vite</strong></div>
                            <div style="margin-bottom: 0.5rem;"><strong>npm install</strong></div>
                            <div><strong>npm run build</strong></div>
                        </div>
                        <p style="color: #6b7280; font-size: 0.9rem; background: #eff6ff; padding: 1rem; border-radius: 0.5rem; border: 1px solid #bfdbfe;">
                            💡 <strong>Tip:</strong> Set <code>APP_ENV=local</code> in your .env file for development mode
                        </p>
                    </div>
                </div>
            `;
        }
    </script>
</body>
</html>
