<?php

/**
 * Example Laravel routes for vadmin-react-vite integration
 * Add these routes to your routes/web.php file
 */

use Illuminate\Support\Facades\Route;

// Main vadmin-react-vite admin interface
Route::get('/admin-vite', function () {
    return view('vadmin-react-vite.index', [
        'siteName' => env('DOMAIN_SITE_TITLE', 'VAdmin'),
        'domain' => request()->getHost(),
        'app' => env('DOMAIN_APP_NAME', 'vadmin-testsite'),
        'themeColor' => env('DOMAIN_THEME_COLOR', '#0ea5e9')
    ]);
})->name('vadmin.react.index');

// Alternative: Group with middleware for authentication
Route::middleware(['web'])->group(function () {
    Route::get('/admin-vite', function () {
        return view('vadmin-react-vite.index', [
            'siteName' => config('app.name', 'VAdmin'),
            'domain' => request()->getHost(),
            'app' => config('app.name', 'vadmin-testsite'),
            'themeColor' => '#0ea5e9',
            // Add user data if authenticated
            'user' => auth()->user()
        ]);
    })->name('vadmin.react.dashboard');
});

// API routes for the React app (optional)
Route::prefix('api')->middleware(['web'])->group(function () {
    Route::get('/config', function () {
        return response()->json([
            'siteName' => config('app.name', 'VAdmin'),
            'domain' => request()->getHost(),
            'app' => config('app.name', 'vadmin-testsite'),
            'themeColor' => '#0ea5e9',
            'environment' => app()->environment(),
            'user' => auth()->user()
        ]);
    });
    
    // Add more API endpoints as needed
    Route::get('/stats', function () {
        return response()->json([
            'users' => ['total' => 2847, 'change' => '+12%'],
            'revenue' => ['total' => '$45,231', 'change' => '+8%'],
            'orders' => ['total' => 1423, 'change' => '+23%'],
            'growth' => ['total' => '15.3%', 'change' => '+2%']
        ]);
    });
});

/*
 * Example .env variables for vadmin-react-vite:
 * 
 * DOMAIN_SITE_TITLE="VAdmin Dashboard"
 * DOMAIN_APP_NAME="vadmin-testsite"
 * DOMAIN_THEME_COLOR="#0ea5e9"
 * APP_ENV=local  # or production
 */
