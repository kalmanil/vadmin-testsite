<?php

use Illuminate\Support\Facades\Route;

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

    // Serve static assets for production build (MUST be before catch-all route)
    Route::get('/resources/views/vadmin-react-vite/dist/assets/{file}', function ($file) {
        $filePath = base_path('apps/vadmin-testsite/resources/views/vadmin-react-vite/dist/assets/' . $file);
        
        if (!file_exists($filePath)) {
            abort(404, "Asset not found: " . $file);
        }
        
        // Set proper MIME types
        $mimeType = match(pathinfo($filePath, PATHINFO_EXTENSION)) {
            'js' => 'application/javascript',
            'css' => 'text/css',
            'json' => 'application/json',
            'html' => 'text/html',
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'svg' => 'image/svg+xml',
            default => 'text/plain'
        };
        
        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'public, max-age=31536000', // 1 year cache for assets
            'ETag' => md5_file($filePath)
        ]);
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


