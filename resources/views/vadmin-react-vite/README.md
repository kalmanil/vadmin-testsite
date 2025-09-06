# VAdmin React + Vite

A modern React + Vite admin interface for the vadmin-testsite Laravel application.

## 🚀 Features

- **Modern React 18** with functional components and hooks
- **Vite** for fast development and optimized builds
- **Tailwind CSS** for utility-first styling
- **React Router** for client-side routing
- **Lucide React** for modern icons
- **Dark/Light Theme** with persistent preferences
- **Responsive Design** with mobile-first approach
- **Error Boundaries** for graceful error handling
- **TypeScript Ready** (dev dependencies included)

## 📁 Project Structure

```
vadmin-react-vite/
├── js/src/
│   ├── components/          # React components
│   │   ├── Dashboard.jsx    # Main dashboard
│   │   ├── Settings.jsx     # Settings page
│   │   ├── Layout.jsx       # App layout wrapper
│   │   └── ErrorBoundary.jsx # Error handling
│   ├── hooks/               # Custom React hooks
│   │   └── useConfig.js     # Configuration hook
│   ├── styles/              # CSS styles
│   │   └── index.css        # Main styles with Tailwind
│   ├── utils/               # Utility functions
│   ├── App.jsx              # Main App component
│   └── main.jsx             # React entry point
├── public/                  # Static assets
├── dist/                    # Built assets (generated)
├── package.json             # Dependencies and scripts
├── vite.config.js           # Vite configuration
├── tailwind.config.js       # Tailwind configuration
├── postcss.config.js        # PostCSS configuration
├── index.blade.php          # Laravel Blade template
└── README.md                # This file
```

## 🛠️ Development Setup

1. **Navigate to the project directory:**
   ```bash
   cd resources/views/vadmin-react-vite
   ```

2. **Install dependencies:**
   ```bash
   npm install
   ```

3. **Start the development server:**
   ```bash
   npm run dev
   ```
   This will start Vite dev server on `http://localhost:5174`

4. **Configure Laravel route** to serve the Blade template:
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

## 📦 Build for Production

1. **Build the application:**
   ```bash
   npm run build
   ```

2. **Preview the production build:**
   ```bash
   npm run preview
   ```

The built files will be in the `dist/` directory and can be served by your Laravel application.

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
