<?php

use Illuminate\Support\Facades\Route;

// Serve all static files from dist folder (NO middleware - must be first!)
Route::get('/resources/views/vadmin-react-vite/dist/{path}', function ($path) {
        $filePath = base_path('apps/vadmin-testsite/resources/views/vadmin-react-vite/dist/' . $path);
        
        // Security: prevent directory traversal
        $realPath = realpath($filePath);
        $distPath = realpath(base_path('apps/vadmin-testsite/resources/views/vadmin-react-vite/dist'));
        
        if (!$realPath || strpos($realPath, $distPath) !== 0) {
            abort(404, "Invalid path");
        }
        
        if (!file_exists($realPath)) {
            abort(404, "File not found: " . $path);
        }
        
        // Set proper MIME types
        $mimeType = match(pathinfo($realPath, PATHINFO_EXTENSION)) {
            'js' => 'application/javascript',
            'mjs' => 'application/javascript',
            'css' => 'text/css',
            'json' => 'application/json',
            'html' => 'text/html',
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml',
            'woff', 'woff2' => 'font/woff',
            'ttf' => 'font/ttf',
            'eot' => 'application/vnd.ms-fontobject',
            default => 'text/plain'
        };
        
        // Shorter cache for manifest, longer for assets
        $cacheMaxAge = basename($realPath) === 'manifest.json' ? 3600 : 31536000;
        
        return response()->file($realPath, [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'public, max-age=' . $cacheMaxAge,
            'ETag' => md5_file($realPath)
        ]);
    })->where('path', '.*');

// Now wrap remaining routes in middleware
Route::middleware('web')->group(function () {
    // Homepage serves the React dashboard directly
    Route::get('/', function () {
        return view('vadmin-react-vite.index', [
            'siteName' => $_ENV['DOMAIN_SITE_TITLE'] ?? 'VAdmin',
            'domain' => request()->getHost(),
            'app' => $_ENV['DOMAIN_APP_NAME'] ?? 'vadmin-testsite',
            'themeColor' => $_ENV['DOMAIN_THEME_COLOR'] ?? '#0ea5e9'
        ]);
    });

    // API routes for React
    Route::prefix('api')->group(function () {
        Route::get('/stats', function () {
            return response()->json([
                'users' => 2847,
                'revenue' => 45231,
                'orders' => 1423,
                'growth' => 15.3
            ]);
        });
        
        Route::get('/activities', function () {
            return response()->json([
                ['action' => 'New user registered', 'time' => '2 minutes ago', 'type' => 'user'],
                ['action' => 'Order #1234 completed', 'time' => '5 minutes ago', 'type' => 'order'],
                ['action' => 'Database backup completed', 'time' => '1 hour ago', 'type' => 'system'],
            ]);
        });
    });

    // Catch-all for React Router (SPA mode)
    Route::get('/{any}', function () {
        return view('vadmin-react-vite.index', [
            'siteName' => $_ENV['DOMAIN_SITE_TITLE'] ?? 'VAdmin',
            'domain' => request()->getHost(),
            'app' => $_ENV['DOMAIN_APP_NAME'] ?? 'vadmin-testsite',
            'themeColor' => $_ENV['DOMAIN_THEME_COLOR'] ?? '#0ea5e9'
        ]);
    })->where('any', '.*');
});


