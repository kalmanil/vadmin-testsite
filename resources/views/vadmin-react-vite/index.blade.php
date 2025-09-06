<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteName }}</title>
    <script src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(135deg, {{ $themeColor ?? '#8b5cf6' }}, #a855f7, #7c3aed);
            color: #1f2937;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        #root {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            max-width: 700px;
            width: 100%;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }
        
        .container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(139, 92, 246, 0.1), transparent);
            animation: shine 3s infinite;
            pointer-events: none;
        }
        
        @keyframes shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
        
        .logo {
            font-size: 4rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, {{ $themeColor ?? '#8b5cf6' }}, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            z-index: 2;
        }
        
        .title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #1f2937;
            position: relative;
            z-index: 2;
        }
        
        .subtitle {
            font-size: 1.1rem;
            color: #6b7280;
            margin-bottom: 2rem;
            position: relative;
            z-index: 2;
        }
        
        .badges {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 2rem;
            position: relative;
            z-index: 2;
        }
        
        .badge {
            background: linear-gradient(135deg, {{ $themeColor ?? '#8b5cf6' }}, #a855f7);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
            transition: transform 0.3s ease;
        }
        
        .badge:hover {
            transform: translateY(-2px) scale(1.05);
        }
        
        .tech-stack {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1rem;
            margin: 2rem 0;
            position: relative;
            z-index: 2;
        }
        
        .tech-item {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            cursor: pointer;
        }
        
        .tech-item:hover {
            background: {{ $themeColor ?? '#8b5cf6' }};
            color: white;
            transform: translateY(-4px);
            border-color: #a855f7;
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.4);
        }
        
        .links {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            position: relative;
            z-index: 2;
        }
        
        .link {
            color: {{ $themeColor ?? '#8b5cf6' }};
            text-decoration: none;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border: 2px solid {{ $themeColor ?? '#8b5cf6' }};
            border-radius: 12px;
            transition: all 0.3s ease;
            background: white;
        }
        
        .link:hover {
            background: {{ $themeColor ?? '#8b5cf6' }};
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.4);
        }
        
        .features {
            margin-top: 2rem;
            text-align: left;
            position: relative;
            z-index: 2;
        }
        
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .feature {
            background: #f1f5f9;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid {{ $themeColor ?? '#8b5cf6' }};
        }
        
        .feature-title {
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.5rem;
        }
        
        .feature-desc {
            font-size: 0.85rem;
            color: #64748b;
        }
        
        .admin-panel {
            background: linear-gradient(135deg, {{ $themeColor ?? '#8b5cf6' }}, #a855f7);
            color: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin: 2rem 0;
            position: relative;
            z-index: 2;
        }
        
        .admin-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .admin-desc {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .container {
            animation: fadeInUp 0.8s ease-out;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 2rem;
                margin: 1rem;
            }
            
            .title {
                font-size: 2rem;
            }
            
            .badges {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div id="root"></div>

    <script type="text/babel">
        const { useState, useEffect } = React;

        function VadminReactViteApp() {
            const [mounted, setMounted] = useState(false);
            const [activeFeature, setActiveFeature] = useState(null);
            
            useEffect(() => {
                setMounted(true);
            }, []);

            const appData = {
                siteName: @json($siteName),
                domain: @json($domain),
                app: @json($app),
                themeColor: @json($themeColor)
            };

            const features = [
                {
                    title: "React 18",
                    desc: "Modern React with hooks and concurrent features"
                },
                {
                    title: "Vite-Ready",
                    desc: "Fast development with modern build tools"
                },
                {
                    title: "Laravel Backend",
                    desc: "Robust PHP framework with Eloquent ORM"
                },
                {
                    title: "Admin Interface",
                    desc: "Built-in Vadmin panel for content management"
                }
            ];

            return (
                <div className="container">
                    <div className="logo">⚛️🚍⚡</div>
                    <h1 className="title">{appData.siteName}</h1>
                    <p className="subtitle">Vadmin React + Vite + Laravel Testsite</p>
                    
                    <div className="badges">
                        <div className="badge">Domain: {appData.domain}</div>
                        <div className="badge">App: {appData.app}</div>
                        <div className="badge">Theme: {appData.themeColor}</div>
                    </div>
                    
                    <div className="admin-panel">
                        <div className="admin-title">🎛️ Vadmin Panel</div>
                        <div className="admin-desc">
                            This is a React+Vite powered interface for the Vadmin testsite app with modern UI components and fast development workflow.
                        </div>
                    </div>
                    
                    <div className="tech-stack">
                        <div className="tech-item">React 18</div>
                        <div className="tech-item">Vite</div>
                        <div className="tech-item">Laravel 12</div>
                        <div className="tech-item">Vadmin</div>
                        <div className="tech-item">PHP 8.2+</div>
                        <div className="tech-item">Blade</div>
                        <div className="tech-item">SQLite</div>
                        <div className="tech-item">MVVM</div>
                    </div>
                    
                    <div className="features">
                        <h3>Key Features</h3>
                        <div className="feature-grid">
                            {features.map((feature, index) => (
                                <div key={index} className="feature">
                                    <div className="feature-title">{feature.title}</div>
                                    <div className="feature-desc">{feature.desc}</div>
                                </div>
                            ))}
                        </div>
                    </div>
                    
                    <div className="links">
                        <a href="/about" className="link">About</a>
                        <a href="/vadmin" className="link">Vadmin Panel</a>
                        <a href="/vadmin/dashboard" className="link">Dashboard</a>
                    </div>
                </div>
            );
        }

        const root = ReactDOM.createRoot(document.getElementById('root'));
        root.render(<VadminReactViteApp />);
    </script>
</body>
</html>