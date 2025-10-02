<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Models\Panier;

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
        View::composer('*', function ($view) {
            $count = 0;
            if (auth()->check()) {
                $panier = Panier::where('utilisateur_id', auth()->id())
                                ->where('statut', 'en_cours')
                                ->with('puzzles')
                                ->first();
                if ($panier) {
                    $count = $panier->puzzles->sum('pivot.quantite');
                }
            }
            $view->with('panierCount', $count);
        });
    }
}
