# VAdmin React + Vite

A modern React + Vite admin interface for the vadmin-testsite Laravel application.

## 🚀 Features

- **Modern React 18** with functional components and hooks
- **Vite** for lightning-fast development and optimized builds
- **Tailwind CSS** for utility-first styling
- **React Router** for client-side routing
- **Lucide React** for modern icons
- **Dark/Light Theme** with persistent preferences
- **Responsive Design** with mobile-first approach
- **Error Boundaries** for graceful error handling
- **Laravel Integration** with config injection
- **Hot Module Replacement** for instant updates
- **TypeScript Ready** (dev dependencies included)

## 📁 Project Structure

```
vadmin-react-vite/
├── js/src/
│   ├── components/          # React components
│   │   ├── Dashboard.jsx    # Feature-rich admin dashboard
│   │   ├── Settings.jsx     # Complete settings page
│   │   ├── Layout.jsx       # Responsive layout with sidebar
│   │   └── ErrorBoundary.jsx # Error handling
│   ├── hooks/               # Custom React hooks
│   │   └── useConfig.js     # Laravel configuration hook
│   ├── styles/              # CSS styles
│   │   └── index.css        # Tailwind + custom styles
│   ├── utils/               # Utility functions
│   ├── App.jsx              # Main App component with routing
│   └── main.jsx             # React entry point
├── public/                  # Static assets
├── dist/                    # Built assets (generated)
├── package.json             # Dependencies and scripts
├── vite.config.js           # Vite configuration
├── tailwind.config.js       # Tailwind configuration
├── postcss.config.js        # PostCSS configuration
├── dev-server.js            # Development helper script
├── index.blade.php          # Laravel Blade template
└── README.md                # This file
```

## 🛠️ Development Setup

### 1. **Navigate to the project directory:**
```bash
cd resources/views/vadmin-react-vite
```

### 2. **Install dependencies:**
```bash
npm install
```

### 3. **Start the development server:**
```bash
npm run dev
```
This will start Vite dev server on `http://localhost:5174` with Hot Module Replacement (HMR)

### 4. **Add Laravel route** to serve the view:
Add this to your Laravel `routes/web.php` or appropriate route file:

```php
Route::get('/admin-vite', function () {
    return view('vadmin-react-vite.index', [
        'siteName' => env('DOMAIN_SITE_TITLE', 'VAdmin'),
        'domain' => request()->getHost(),
        'app' => env('DOMAIN_APP_NAME', 'vadmin-testsite'),
        'themeColor' => env('DOMAIN_THEME_COLOR', '#0ea5e9')
    ]);
});
```

### 5. **Access your app:**
- **Development:** Visit your Laravel app at `/admin-vite` (e.g., `http://localhost:8000/admin-vite`)
- **Vite Dev Server:** The React app will be served from `http://localhost:5174`

## 📦 Build for Production

### 1. **Build the application:**
```bash
npm run build
```

### 2. **Preview the production build:**
```bash
npm run preview
```

### 3. **Deploy built assets:**
The built files will be in the `dist/` directory with a manifest.json file. The Laravel Blade template automatically detects production mode and loads the correct assets.

### 4. **Production Laravel route:**
```php
Route::get('/admin-vite', function () {
    return view('vadmin-react-vite.index', [
        'siteName' => env('DOMAIN_SITE_TITLE', 'VAdmin'),
        'domain' => request()->getHost(),
        'app' => env('DOMAIN_APP_NAME', 'vadmin-testsite'),
        'themeColor' => env('DOMAIN_THEME_COLOR', '#0ea5e9')
    ]);
});
```

## 🔗 Laravel Integration

### **How it Works:**
1. **Development Mode:** Laravel detects `local` environment and loads Vite dev server assets
2. **Production Mode:** Laravel reads `dist/manifest.json` and loads built CSS/JS files
3. **Configuration:** Laravel injects config via `window.__VADMIN_CONFIG__`
4. **Assets:** Vite handles CSS extraction, JS bundling, and asset optimization

### **Environment Detection:**
```php
@if(app()->environment('local'))
    {{-- Development: Vite dev server --}}
    <script type="module" src="http://localhost:5174/@vite/client"></script>
    <script type="module" src="http://localhost:5174/js/src/main.jsx"></script>
@else
    {{-- Production: Built assets --}}
    @if(file_exists(resource_path('views/vadmin-react-vite/dist/manifest.json')))
        {{-- Load CSS and JS from manifest --}}
    @endif
@endif
```

## 🚀 Quick Start

1. **Clone and navigate:**
   ```bash
   cd resources/views/vadmin-react-vite
   ```

2. **Install and start:**
   ```bash
   npm install
   npm run dev
   ```

3. **Add Laravel route and visit `/admin-vite`**

## 🔧 Available Scripts

- `npm run dev` - Start Vite development server
- `npm run dev:help` - Show development setup help
- `npm run build` - Build for production
- `npm run preview` - Preview production build
- `npm run lint` - Run ESLint (when configured)
- `npm run clean` - Clean dist directory

## 🎨 Customization

### Theme Colors
Modify `tailwind.config.js` to customize the color scheme:

```javascript
theme: {
  extend: {
    colors: {
      'brand': {
        // Your custom brand colors
      }
    }
  }
}
```

### Components
All components are in `js/src/components/`. They follow modern React patterns:
- Functional components with hooks
- Proper prop types (add PropTypes if needed)
- Accessible design patterns
- Responsive layouts

### Configuration
The app receives configuration from Laravel via `window.__VADMIN_CONFIG__`. Available options:
- `siteName` - Application name
- `domain` - Current domain
- `app` - App identifier
- `themeColor` - Primary theme color
- `apiBase` - API base URL
- `csrfToken` - CSRF token for API calls
- `user` - Current user data
- `environment` - App environment

## 🔧 Available Scripts

- `npm run dev` - Start development server
- `npm run build` - Build for production
- `npm run preview` - Preview production build
- `npm run lint` - Run ESLint (when configured)

## 🌐 Integration with Laravel

The Blade template (`index.blade.php`) handles:
- Development/production mode detection
- Asset loading (CSS/JS)
- Configuration injection
- SEO meta tags
- Loading states

## 📱 Responsive Design

The interface is fully responsive with:
- Mobile-first design approach
- Collapsible sidebar on mobile
- Touch-friendly interactions
- Optimized layouts for all screen sizes

## 🎯 Next Steps

1. Add more pages/components as needed
2. Implement API integration with Laravel backend
3. Add form validation and state management
4. Configure TypeScript for better development experience
5. Add testing setup (Jest, React Testing Library)
6. Implement real authentication flow
7. Add more dashboard widgets and functionality

## 🐛 Troubleshooting

**Vite dev server not connecting:**
- Ensure port 5174 is available
- Check firewall settings
- Verify the dev server URL in the Blade template

**Styles not loading:**
- Run `npm run build` for production
- Check that Tailwind is properly configured
- Verify PostCSS setup

**React components not rendering:**
- Check browser console for errors
- Verify all imports are correct
- Ensure the target DOM element exists
