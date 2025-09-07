<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('/', function () {
        return view($_ENV['DOMAIN_VIEW_TEMPLATE'], [
            'siteName' => $_ENV['DOMAIN_SITE_TITLE'],
            'domain' => request()->getHost(),
            'app' => $_ENV['DOMAIN_APP_NAME'],
            'themeColor' => $_ENV['DOMAIN_THEME_COLOR']
        ]);
    });

    // VAdmin React + Vite modern admin interface
    Route::get('/admin-vite', function () {
        return view('vadmin-react-vite.admin', [
            'siteName' => $_ENV['DOMAIN_SITE_TITLE'] ?? 'VAdmin',
            'domain' => request()->getHost(),
            'app' => $_ENV['DOMAIN_APP_NAME'] ?? 'vadmin-testsite',
            'themeColor' => $_ENV['DOMAIN_THEME_COLOR'] ?? '#0ea5e9'
        ]);
    });
});


