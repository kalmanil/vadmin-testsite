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

    {{-- Global config for React --}}
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

    {{-- Loading fallback styles --}}
    <style>
        body { margin: 0; font-family: system-ui, sans-serif; background: #f9fafb; color: #111827; }
        .loading-container { display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .spinner { width: 3rem; height: 3rem; border: 4px solid #dbeafe; border-top-color: #2563eb; border-radius: 50%; animation: spin 1s linear infinite; margin-bottom: 1rem; }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>
<body>
    <div id="vadmin-root">
        {{-- Loading fallback --}}
        <div class="loading-container">
            <div>
                <div class="spinner"></div>
                <h1>{{ $siteName }}</h1>
                <p>Loading modern admin interface...</p>
            </div>
        </div>
    </div>

    <script type="module">
        const isLocal = @json(app()->environment('local'));
        const vitePort = 5178;
        const viteDevServer = `${window.location.protocol}//${window.location.hostname}:${vitePort}`;

        if (isLocal) {
            // 1️⃣ Load Vite client first (prevents preamble error)
            const viteClient = document.createElement('script');
            viteClient.type = 'module';
            viteClient.src = viteDevServer + '/@' + 'vite/client';
            document.head.appendChild(viteClient);

            // 2️⃣ Load React entrypoint after client
            const mainScript = document.createElement('script');
            mainScript.type = 'module';
            mainScript.src = viteDevServer + '/js/src/main.jsx'; // adjust path if needed
            document.head.appendChild(mainScript);

            console.log('✅ VAdmin React Vite: Dev mode loaded from port ' + vitePort);
        } else {
            // Production: load built assets from /public/vadmin-react-vite/dist
            fetch('/vadmin-react-vite/dist/.vite/manifest.json')
                .then(r => r.json())
                .then(manifest => {
                    const entry = manifest['js/src/main.jsx'];
                    if (!entry) throw new Error("Entrypoint not found in manifest");

                    // Load CSS
                    if (entry.css) {
                        entry.css.forEach(file => {
                            const link = document.createElement('link');
                            link.rel = 'stylesheet';
                            link.href = '/vadmin-react-vite/dist/' + file;
                            document.head.appendChild(link);
                        });
                    }

                    // Load JS
                    const script = document.createElement('script');
                    script.type = 'module';
                    script.src = '/vadmin-react-vite/dist/' + entry.file;
                    document.head.appendChild(script);

                    console.log('✅ VAdmin React Vite: Production mode loaded');
                })
                .catch(e => console.error('❌ VAdmin React Vite: No manifest found', e));
        }
    </script>
</body>
</html>
