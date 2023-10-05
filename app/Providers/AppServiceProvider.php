<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Frontend;
use App\Helpers\Frontend\Helper;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {

            $helper = new Helper();
            $favicon = DB::table('configs')->where('id', 1)->first();
            $logo = DB::table('configs')->where('id', 2)->first();
            $footer_logo = DB::table('configs')->where('id', 3)->first();
            $view->with('favicon', $favicon->flag_value);
            $view->with('logo', $logo->flag_value);
            $view->with('helper', $helper);
            $view->with('footer_logo', $logo->flag_value);
        });
    }
}
