<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as ViewInstance;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        View::composer(['partials.header', 'partials.sidebar'], function (ViewInstance $view): void {
            $position = $view->getName() === 'partials.header' ? 'header' : 'sidebar';

            $menus = Menu::query()
                ->where('trang_thai', true)
                ->where('vi_tri', $position)
                ->orderBy('thu_tu')
                ->orderBy('id')
                ->get();

            $view->with('menus', $menus);
        });
    }
}
