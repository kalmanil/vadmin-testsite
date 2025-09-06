<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteName }} Admin</title>
    <style>
        html, body {
            height: 100%;
        }
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Fira Sans", "Droid Sans", "Helvetica Neue", Arial, "Apple Color Emoji", "Segoe UI Emoji";
            background: #0f172a;
            color: #e5e7eb;
        }
        #root {
            min-height: 100vh;
        }
        .fallback {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(135deg, {{ $themeColor ?? '#6366f1' }}, #0ea5e9);
        }
        .fallback h1 {
            font-size: 2rem;
            margin: 0;
        }
    </style>
    <script>
        window.__INITIAL_STATE__ = {
            siteName: @json($siteName),
            domain: @json($domain),
            app: @json($app),
            themeColor: @json($themeColor)
        };
    </script>
    @include('shared.badge-js')
    @include('vadmin-react._model')
    @include('vadmin-react._viewmodel')
    @include('vadmin-react._view')
    <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
</head>
<body>
    <div id="root">
        <div class="fallback">
            <h1>Loading {{ $siteName }}…</h1>
        </div>
    </div>

    <script>
        (function () {
            const { createRoot } = ReactDOM;
            const model = window.VAdminReact.model;
            const viewModel = window.VAdminReact.createViewModel(model);
            function App() { return React.createElement(window.VAdminReact.AdminView, { viewModel }); }
            const root = createRoot(document.getElementById('root'));
            root.render(React.createElement(App));
        })();
    </script>
</body>
</html>


