<?php

namespace App\Providers;

use App\Http\ViewComposer\ServiceComposer;
use App\Http\ViewComposer\SocialLinkComposer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if (!function_exists('active_theme')) {
            return;
        }

        try {
            if (!Schema::hasTable('themes')) {
                return;
            }

            $theme = active_theme();

            View::composer("{$theme}.layouts.footer", ServiceComposer::class);
            View::composer("{$theme}.layouts.footer", SocialLinkComposer::class);
            View::composer("{$theme}.layouts.navbar", SocialLinkComposer::class);
        } catch (\Throwable $e) {
            View::composer('frontend.theme-1.layouts.footer', ServiceComposer::class);
            View::composer('frontend.theme-1.layouts.footer', SocialLinkComposer::class);
            View::composer('frontend.theme-1.layouts.navbar', SocialLinkComposer::class);
        }
    }
}
